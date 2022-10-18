<?php

namespace App\Services;

use App\Models\Share;
use Metaseller\TinkoffInvestApi2\helpers\QuotationHelper;
use Metaseller\TinkoffInvestApi2\providers\InstrumentsProvider;
use Metaseller\TinkoffInvestApi2\TinkoffClientsFactory;
use Tinkoff\Invest\V1\GetFavoritesRequest;
use Tinkoff\Invest\V1\GetLastPricesRequest;
use Tinkoff\Invest\V1\InstrumentsRequest;
use Tinkoff\Invest\V1\InstrumentStatus;

class ShareService
{
    public static function getFavorite()
    {
        $token = env('TOKEN');

        $factory = TinkoffClientsFactory::create($token);

        $instrumentsRequest = new InstrumentsRequest();
        $instrumentsRequest->setInstrumentStatus(InstrumentStatus::INSTRUMENT_STATUS_ALL);

        list($favorites, $status) = $factory->instrumentsServiceClient->GetFavorites(new GetFavoritesRequest())->wait();

        $result = [];
        foreach ($favorites->getFavoriteInstruments() as $favoriteInstrument) {
            $instrumentsProvider = new InstrumentsProvider($factory);

            $share = $instrumentsProvider->searchByFigi($favoriteInstrument->getFigi());

            $lastPricesRequest = new GetLastPricesRequest();
            $lastPricesRequest->setFigi([$share->getFigi()]);
            list($response, $status) = $factory->marketDataServiceClient->GetLastPrices($lastPricesRequest)->wait();

            if ($response) {
                $lastPrice = $response->getLastPrices()[0];
                $price = $lastPrice->getPrice();
                $priceInCurrency = $price ? QuotationHelper::toCurrency($price, $share) : null;
                $result[] = [
                    'figi' => $share->getFigi(),
                    'ticker' => $share->getTicker(),
                    'name' => $share->getName(),
                    'currency' => $share->getCurrency(),
                    'price' => $priceInCurrency,
                    'type' => $favoriteInstrument->getInstrumentType()
                ];
            }
        }
        return $result;
    }

    public static function updatePrices()
    {
        foreach (self::getFavorite() as $item) {
            $share = Share::where('figi', $item['figi'])->first();
            if (!$share) {
                $share = new Share();
            }
            $share->figi = $item['figi'];
            $share->ticker = $item['ticker'];
            $share->name = $item['name'];
            $share->last_price = $item['price'];
            $share->currency = $item['currency'];
            $share->type = $item['type'];
            $share->save();
        }
    }

}
