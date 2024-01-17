<?php

namespace App\Components\Wildberries;

use Carbon\CarbonImmutable;

class Good
{
    public CarbonImmutable $lastChangeDate;
    public string $warehouseName;
    public string $supplierArticle;
    public int $nmId;
    public string $barcode;
    public int $quantity;
    public int $inWayToClient;
    public int $inWayFromClient;
    public int $quantityFull;
    public string $category;
    public string $subject;
    public string $brand;
    public string $techSize;
    public float $price;
    public float $discount;
    public bool $isSupply;
    public bool $isRealization;
    public string $SCCode;

    public function __construct(array $data)
    {
        $this->lastChangeDate = CarbonImmutable::parse($data['lastChangeDate']);
        $this->warehouseName = $data['warehouseName'];
        $this->supplierArticle = $data['supplierArticle'];
        $this->nmId = $data['nmId'];
        $this->barcode = $data['barcode'];
        $this->quantity = $data['quantity'];
        $this->inWayToClient = $data['inWayToClient'];
        $this->inWayFromClient = $data['inWayFromClient'];
        $this->quantityFull = $data['quantityFull'];
        $this->category = $data['category'];
        $this->subject = $data['subject'];
        $this->brand = $data['brand'];
        $this->techSize = $data['techSize'];
        $this->price = $data['Price'];
        $this->discount = $data['Discount'];
        $this->isSupply = $data['isSupply'];
        $this->isRealization = $data['isRealization'];
        $this->SCCode = $data['SCCode'];
    }
}
