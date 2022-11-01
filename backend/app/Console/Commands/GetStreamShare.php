<?php

namespace App\Console\Commands;

use App\Services\ShareService;
use Illuminate\Console\Command;
use Metaseller\TinkoffInvestApi2\TinkoffClientsFactory;
use Tinkoff\Invest\V1\MarketDataRequest;
use Tinkoff\Invest\V1\MarketDataResponse;
use Tinkoff\Invest\V1\SubscribeLastPriceRequest;
use Tinkoff\Invest\V1\SubscriptionAction;

class GetStreamShare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shares:stream';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $token = env("TOKEN");

        $factory = TinkoffClientsFactory::create($token);

        $namesShare = ShareService::getNames();

        /** Создаем подписку на данные {@link MarketDataRequest}, конкретно по {@link SubscribeLastPriceRequest} по FIGI инструмента META/FB */
        $subscription = (new MarketDataRequest())
            ->setSubscribeLastPriceRequest(
                (new SubscribeLastPriceRequest())
                    ->setSubscriptionAction(SubscriptionAction::SUBSCRIPTION_ACTION_SUBSCRIBE)
                    ->setInstruments(ShareService::getSubscriptionsShare())
            );

        $stream = $factory->marketDataStreamServiceClient->MarketDataStream();
        $stream->write($subscription);

        /** В цикле получаем данные от сервера */

        /** @var MarketDataResponse $market_data_response */
        while ($marketDataResponse = $stream->read()) {
            if ($orderbook = $marketDataResponse->getLastPrice()) {
                echo $namesShare[$orderbook->getFigi()] .": ". $orderbook->getPrice()
                        ->getUnits() + $orderbook->getPrice()
                        ->getNano() / pow(10, 9). PHP_EOL;
            } else {
                echo 'No orderbook data' . PHP_EOL;
            }
        }

        $stream->cancel();
    }
}
