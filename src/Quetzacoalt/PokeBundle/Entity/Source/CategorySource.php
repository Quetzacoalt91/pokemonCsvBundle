<?php

namespace Quetzacoalt\PokeBundle\Entity\Source;

abstract class CategorySource
{
    protected $ps_id;
    protected $active;
    protected $name;
    protected $parentCategory;
    protected $rootCategory;
    protected $description;
    protected $metaTitle;
    protected $metaKeywords;
    protected $metaDescription;
    protected $rewrittenURL;
    protected $imageURL;
    
    public function getPsId() {
        return $this->ps_id;
    }
    
    public function getActive() {
        return $this->active;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getImageURL() {
        return $this->imageURL;
    }

    public function getMetaDescription() {
        return $this->metaDescription;
    }

    public function getMetaKeywords() {
        return $this->metaKeywords;
    }

    public function getMetaTitle() {
        return $this->metaTitle;
    }

    public function getName() {
        return $this->name;
    }

    public function getParentCategory() {
        return $this->parentCategory;
    }

    public function getRewrittenURL() {
        return $this->rewrittenURL;
    }

    public function getRootCategory() {
        return $this->rootCategory;
    }

}
