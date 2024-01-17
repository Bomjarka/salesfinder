<?php

namespace App\Components\Wildberries;

class WildberriesStockMapper
{
    /**
     * @param array $stocks
     * @return array
     */
    public function mapFromResponse(array $stocks): array
    {
        $data = [];

        foreach ($stocks as $stock) {
            $data[] = new Good($stock);
        }

        return $data;
    }
}
