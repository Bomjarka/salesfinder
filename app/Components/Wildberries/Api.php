<?php

namespace App\Components\Wildberries;

use App\Components\MarketplaceApi;
use App\Models\Shop;
use Carbon\CarbonImmutable;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Api implements MarketplaceApi
{
    protected const METHOD_STOCKS = 'stocks';
    protected WildberriesStockMapper $mapper;

    public function __construct(protected Shop $shop)
    {
        $this->mapper = new WildberriesStockMapper();
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function getStocks(CarbonImmutable $from)
    {
        $stocksUrl = \config('wildberries.supplier.url');
        $method = self::METHOD_STOCKS;

        $url = $stocksUrl . "/{$method}?dateFrom={$from->toDateString()}";

        $response = $this->doRequest('GET', $url);

        return $this->mapper->mapFromResponse($response);
    }

    /**
     * @param string $method
     * @param string $url
     * @return mixed
     * @throws GuzzleException
     * @throws \JsonException
     */
    protected function doRequest(string $method, string $url): mixed
    {
        $client = new Client();
        $response = $client->request($method, $url, [
            'headers' => [
                'Authorization' => $this->shop->getActiveToken()->token
                ],
            ]);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }
}
