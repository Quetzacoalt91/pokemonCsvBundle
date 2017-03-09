<?php

namespace Quetzacoalt\PokeBundle\Entity;

class Product
{
    protected $id;
    public $ps_id;
    public $active;
    public $name;
    public $categories;
    public $priceTaxIncluded;
    public $taxRulesId;
    public $wholesalePrice;
    public $onSale;
    public $discountAmount;
    public $discountPercent;
    public $discountFrom; // (yyyy-mm-dd)
    public $discountTo; // (yyyy-mm-dd)
    public $reference;
    public $supplierReference;
    public $supplier;
    public $manufacturer;
    public $ean13;
    public $upc;
    public $ecotax;
    public $width;
    public $height;
    public $depth;
    public $weight;
    public $quantity;
    public $minimalQuantity;
    public $visibility;
    public $additionalShippingCost;
    public $unity;
    public $unitPrice;
    public $shortdescription;
    public $description;
    public $tags; // (x,y,z...)
    public $metaTitle;
    public $metaKeywords;
    public $metaDescription;
    public $urlRewritten;
    public $textWhenInStock;
    public $textWhenBackorderAllowed;
    public $availableForOrder; //(0 = No, 1 = Yes)
    public $productAvailableDate;
    public $productCreationDate;
    public $showPrice; // (0 = No, 1 = Yes)
    public $imageUrls; // (x,y,z...)
    public $imageAltTexts; // (x,y,z...)
    public $deleteExistingImages; // (0 = No, 1 = Yes)
    public $feature; //(Name:Value:Position)
    public $availableOnlineOnly; // (0 = No, 1 = Yes)
    public $condition;
    public $customizable; // (0 = No, 1 = Yes)
    public $uploadableFiles; // (0 = No, 1 = Yes)
    public $textFields; // (0 = No, 1 = Yes)
    public $outOfStock;
    public $shopId; 
    public $advancedStockManagement;
    public $dependsOnStock;
    public $warehouse;
    
    /**
     * We need this static "constructor", in order to match the mapping ORM
     * file used by Doctrine
     * 
     * @param Product subclass $source
     * @return \self
     */
    public static function createFromProductSource (Product $source)
    {
        $product = new self();
        $product->ps_id = $source->ps_id;
        $product->active = $source->active;
        $product->name = $source->name;
        $product->categories = $source->categories;
        $product->priceTaxIncluded = $source->priceTaxIncluded;
        $product->taxRulesId = $source->taxRulesId;
        $product->wholesalePrice = $source->wholesalePrice;
        $product->onSale = $source->onSale;
        $product->discountAmount = $source->discountAmount;
        $product->discountPercent = $source->discountPercent;
        $product->discountFrom = $source->discountFrom;
        $product->discountTo = $source->discountTo;
        $product->reference = $source->reference;
        $product->supplierReference = $source->supplierReference;
        $product->supplier = $source->supplier;
        $product->manufacturer = $source->manufacturer;
        $product->ean13 = $source->ean13;
        $product->upc = $source->upc;
        $product->ecotax = $source->ecotax;
        $product->width = $source->width;
        $product->height = $source->height;
        $product->depth = $source->depth;
        $product->weight = $source->weight;
        $product->quantity = $source->quantity;
        $product->minimalQuantity = $source->minimalQuantity;
        $product->visibility = $source->visibility;
        $product->additionalShippingCost = $source->additionalShippingCost;
        $product->unity = $source->unity;
        $product->unitPrice = $source->unitPrice;
        $product->shortdescription = $source->shortdescription;
        $product->description = $source->description;
        $product->tags = $source->tags;
        $product->metaTitle = $source->metaTitle;
        $product->metaKeywords = $source->metaKeywords;
        $product->metaDescription = $source->metaDescription;
        $product->urlRewritten = $source->urlRewritten;
        $product->textWhenInStock = $source->textWhenInStock;
        $product->textWhenBackorderAllowed = $source->textWhenBackorderAllowed;
        $product->availableForOrder = $source->availableForOrder;
        $product->productAvailableDate = $source->productAvailableDate;
        $product->productCreationDate = $source->productCreationDate;
        $product->showPrice = $source->showPrice;
        $product->imageUrls = $source->imageUrls;
        $product->imageAltTexts = $source->imageAltTexts;
        $product->deleteExistingImages = $source->deleteExistingImages;
        $product->feature = $source->feature;
        $product->availableOnlineOnly = $source->availableOnlineOnly;
        $product->condition = $source->condition;
        $product->customizable = $source->customizable;
        $product->uploadableFiles = $source->uploadableFiles;
        $product->textFields = $source->textFields;
        $product->outOfStock = $source->outOfStock;
        $product->shopId = $source->shopId;
        $product->advancedStockManagement = $source->advancedStockManagement;
        $product->dependsOnStock = $source->dependsOnStock;
        $product->warehouse = $source->warehouse;
        
        return $product;
    }

}
