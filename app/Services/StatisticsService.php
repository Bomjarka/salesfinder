<?php

namespace App\Services;

use App\Components\Wildberries\Api;
use App\Models\Shop;
use Carbon\CarbonImmutable;
use GuzzleHttp\Exception\GuzzleException;

class StatisticsService
{
    /**
     * @param Shop $shop
     * @param CarbonImmutable $from
     * @return array
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function getStocks(Shop $shop, CarbonImmutable $from): array
    {
        return (new Api($shop))->getStocks($from);
    }
}
