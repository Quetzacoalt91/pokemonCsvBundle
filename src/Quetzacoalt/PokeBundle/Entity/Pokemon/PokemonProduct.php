<?php


namespace Quetzacoalt\PokeBundle\Entity\Pokemon;

use Quetzacoalt\PokeBundle\Entity\Product;

class PokemonProduct extends Product
{
    // Documentation https://pokeapi.co/docsv2/#pokemon
    
    public function __construct($id, $data)
    {
        $name = $data->name;
        $this->ps_id = $id;
        $this->active = true;
        $this->name = $name;
        $this->categories = $data->types;
        $this->priceTaxIncluded = $this->makePrice($data);
        $this->taxRulesId = 1;
        $this->wholesalePrice = $this->priceTaxIncluded * 0.8;
        $this->onSale = true;
        $this->discountAmount = $data->discountAmount;
        $this->discountPercent = $data->discountPercent;
        $this->discountFrom = '2017-01-01';
        $this->discountTo = '2030-01-01';
        $this->reference = $data->reference;
        $this->supplierReference = $data->supplierReference;
        $this->supplier = $data->supplier;
        //$this->manufacturer = $data->manufacturer;
        //$this->ean13 = $data->ean13;
        $this->upc = $data->upc;
        $this->ecotax = $data->ecotax;
        $this->width = 0; //$data->width;
        $this->height = $data->height;
        $this->depth = 0; //$data->depth;
        $this->weight = $data->weight;
        $this->quantity = $data->quantity;
        $this->minimalQuantity = $data->minimalQuantity;
        $this->visibility = $data->visibility;
        $this->additionalShippingCost = $data->additionalShippingCost;
        $this->unity = $data->unity;
        $this->unitPrice = $data->unitPrice;
        $this->shortdescription = $data->shortdescription;
        $this->description = $data->description;
        $this->tags = $data->tags;
        $this->metaTitle = $data->metaTitle;
        $this->metaKeywords = $data->metaKeywords;
        $this->metaDescription = $data->metaDescription;
        $this->urlRewritten = $data->urlRewritten;
        $this->textWhenInStock = $data->textWhenInStock;
        $this->textWhenBackorderAllowed = $data->textWhenBackorderAllowed;
        $this->availableForOrder = $data->availableForOrder;
        $this->productAvailableDate = $data->productAvailableDate;
        $this->productCreationDate = $data->productCreationDate;
        $this->showPrice = $data->showPrice;
        $this->imageUrls = implode(',', $data->images);
        $this->imageAltTexts = $data->imageAltTexts;
        $this->deleteExistingImages = $data->deleteExistingImages;
        $this->feature = $data->feature;
        $this->availableOnlineOnly = $data->availableOnlineOnly;
        $this->condition = $data->condition;
        $this->customizable = $data->customizable;
        $this->uploadableFiles = $data->uploadableFiles;
        $this->textFields = $data->textFields;
        $this->outOfStock = $data->outOfStock;
        $this->shopId = $data->shopId;
        $this->advancedStockManagement = $data->advancedStockManagement;
        $this->dependsOnStock = $data->dependsOnStock;
        $this->warehouse = $data->warehouse;
    }

    private function makePrice($data)
    {
        $price = 0;
        $price += ($data->weight * $data->height);
        $price += $data->base_experience * 2;
        $price += count($data->types) * 20;
        $price += -(count($data->location_area_encounters)) * 50;
        return $price;
    }
}
