<?php

namespace Quetzacoalt\PokeBundle\Entity;

use Quetzacoalt\PokeBundle\Entity\Source\CategorySource;

class Category {
    protected $id;
    public $ps_id;
    public $active;
    public $name;
    public $parentCategory;
    public $rootCategory;
    public $description;
    public $metaTitle;
    public $metaKeywords;
    public $metaDescription;
    public $rewrittenURL;
    public $imageURL;
    
    private function __construct($ps_id, $active, $name, $parentCategory, $rootCategory, $description, $metaTitle, $metaKeywords, $metaDescription, $rewrittenURL, $imageURL) {
        $this->ps_id = $ps_id;
        $this->active = $active;
        $this->name = $name;
        $this->parentCategory = $parentCategory;
        $this->rootCategory = $rootCategory;
        $this->description = $description;
        $this->metaTitle = $metaTitle;
        $this->metaKeywords = $metaKeywords;
        $this->metaDescription = $metaDescription;
        $this->rewrittenURL = $rewrittenURL;
        $this->imageURL = $imageURL;
    }

    /**
     * 
     * @param CategorySourceInterface $cat
     * @return \self
     */
    public static function createFromCategorySource (CategorySource $cat)
    {
        return new self(
                $cat->getPsId(),
                $cat->getActive(),
                $cat->getName(),
                $cat->getParentCategory(),
                $cat->getRootCategory(),
                $cat->getDescription(),
                $cat->getMetaTitle(),
                $cat->getMetaKeywords(),
                $cat->getMetaDescription(),
                $cat->getRewrittenURL(),
                $cat->getImageURL()
        );
    }

}
