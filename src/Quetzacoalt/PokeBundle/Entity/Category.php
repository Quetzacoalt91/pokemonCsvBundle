<?php

namespace Quetzacoalt\PokeBundle\Entity;

class Category
{
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

    /**
     * We need this static "constructor", in order to match the mapping ORM
     * file used by Doctrine
     * 
     * @param Category subclass $source
     * @return \self
     */
    public static function createFromCategorySource (Category $source)
    {
        $cat = new self();
        $cat->ps_id = $source->ps_id;
        $cat->active = $source->active;
        $cat->name = $source->name;
        $cat->parentCategory = $source->parentCategory;
        $cat->rootCategory = $source->rootCategory;
        $cat->description = $source->description;
        $cat->metaTitle = $source->metaTitle;
        $cat->metaKeywords = $source->metaKeywords;
        $cat->metaDescription = $source->metaDescription;
        $cat->rewrittenURL = $source->rewrittenURL;
        $cat->imageURL = $source->imageURL;
        
        return $cat;
    }
}
