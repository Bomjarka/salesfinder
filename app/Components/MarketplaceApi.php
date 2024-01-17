<?php

namespace App\Components;

use Carbon\CarbonImmutable;

interface MarketplaceApi
{
    public function getStocks(CarbonImmutable $from);
}
