<?php

namespace App\Services;

use App\Models\Share;
use App\Models\Subscription;
use Metaseller\TinkoffInvestApi2\helpers\QuotationHelper;
use Metaseller\TinkoffInvestApi2\providers\InstrumentsProvider;
use Metaseller\TinkoffInvestApi2\TinkoffClientsFactory;
use Tinkoff\Invest\V1\GetFavoritesRequest;
use Tinkoff\Invest\V1\GetLastPricesRequest;
use Tinkoff\Invest\V1\InstrumentsRequest;
use Tinkoff\Invest\V1\InstrumentStatus;
use Tinkoff\Invest\V1\LastPriceInstrument;

class ShareService
{
    public static function updatePrices()
    {
        $token = env('TOKEN');

        $factory = TinkoffClientsFactory::create($token);

        $instrumentsRequest = new InstrumentsRequest();
        $instrumentsRequest->setInstrumentStatus(InstrumentStatus::INSTRUMENT_STATUS_ALL);

        list($favorites) = $factory->instrumentsServiceClient->GetFavorites(new GetFavoritesRequest())->wait();

        $count = count($favorites->getFavoriteInstruments());
        $i = 1;
        foreach ($favorites->getFavoriteInstruments() as $favoriteInstrument) {
            $instrumentsProvider = new InstrumentsProvider($factory);

            $share = $instrumentsProvider->searchByFigi($favoriteInstrument->getFigi());
            echo round($i++ / $count * 100, 1) . '%. Обновление '. $share->getName(). "\n";

            $lastPricesRequest = new GetLastPricesRequest();
            $lastPricesRequest->setFigi([$share->getFigi()]);
            list($response) = $factory->marketDataServiceClient->GetLastPrices($lastPricesRequest)->wait();

            if ($response) {
                $lastPrice = $response->getLastPrices()[0];
                $price = $lastPrice->getPrice();
                $priceInCurrency = $price ? QuotationHelper::toCurrency($price, $share) : null;

                $shareModel = Share::where('figi', $share->getFigi())->first();
                if (!$shareModel) {
                    $shareModel = new Share();
                }
                $shareModel->figi = $share->getFigi();
                $shareModel->ticker = $share->getTicker();
                $shareModel->name = $share->getName();
                $shareModel->last_price = $priceInCurrency;
                $shareModel->currency = $share->getCurrency();
                $shareModel->type = $favoriteInstrument->getInstrumentType();
                $shareModel->save();
            }
        }
    }

    public static function getNames()
    {
        $result = [];
        foreach (Share::all() as $item) {
            $result[$item->figi] = $item->name;
        }
        return $result;
    }

    public static function getSubscriptionsShare()
    {
        $result = [];
        foreach (Subscription::all() as $item) {
            $result[] = (new LastPriceInstrument())->setFigi($item->share->figi);
        }
        return $result;
    }

}
