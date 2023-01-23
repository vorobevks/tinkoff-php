<?php

namespace App\Services;

use App\DTO\Operations\PortfolioDto;
use App\DTO\Operations\PortfolioPositionDto;
use App\Traits\TokenTrait;
use Metaseller\TinkoffInvestApi2\ClientConnection;
use Tinkoff\Invest\V1\MoneyValue;
use Tinkoff\Invest\V1\OperationsServiceClient;
use Tinkoff\Invest\V1\PortfolioPosition;
use Tinkoff\Invest\V1\PortfolioRequest;
use Tinkoff\Invest\V1\Quotation;

class OperationsService
{
    use TokenTrait;

    /**
     * @param string|int $accountId
     * @return PortfolioDto
     */
    public static function getPortfolio(string|int $accountId): PortfolioDto
    {
        $operationsServiceClient = new OperationsServiceClient(ClientConnection::getHostname(), ClientConnection::getOptions(self::getToken()));

        $portfolioRequest = (new PortfolioRequest())->setAccountId($accountId);
        list($portfolio, $status) = $operationsServiceClient->GetPortfolio($portfolioRequest)->wait();

        return new PortfolioDto([
           'totalAmountShares' => self::calcPrice($portfolio->getTotalAmountShares()),
           'totalAmountBonds' => self::calcPrice($portfolio->getTotalAmountBonds()),
           'totalAmountEtf' => self::calcPrice($portfolio->getTotalAmountEtf()),
           'totalAmountCurrencies' => self::calcPrice($portfolio->getTotalAmountCurrencies()),
           'totalAmountFutures' => self::calcPrice($portfolio->getTotalAmountFutures()),
           'expectedYield' => self::calcPrice($portfolio->getExpectedYield()),
           'positions' => self::preparePositions($portfolio->getPositions()),
        ]);
    }

    private static function calcPrice(MoneyValue|Quotation $field): float|int|string
    {
        return $field->getUnits() + $field->getNano() / pow(10, 9);
    }

    private static function preparePositions($positions)
    {
        $result = [];
        /** @var PortfolioPosition $position */
        foreach ($positions as $position) {
            $result[] = new PortfolioPositionDto(
                [
                    'figi' => $position->getFigi(),
                    'name' => ShareService::getNameByFigi($position->getFigi()),
                    'instrumentType' => $position->getInstrumentType(),
                    'quantity' => self::calcPrice($position->getQuantity()),
                    'quantityLots' => self::calcPrice($position->getQuantityLots()),
                    'currentPrice' => self::calcPrice($position->getCurrentPrice()),
                    'currency' => $position->getCurrentPrice()->getCurrency()
                ]
            );
        }
        return $result;
    }
}
