<?php


namespace Quetzacoalt\PokeBundle\Entity\Pokemon;

use Quetzacoalt\PokeBundle\Entity\Source\CategorySource;

class PokemonCategory extends CategorySource
{
    // Documentation https://pokeapi.co/docsv2/#types
    private $ps_id;
    private $active;
    private $name;
    private $parentCategory;
    private $rootCategory;
    private $description;
    private $metaTitle;
    private $metaKeywords;
    private $metaDescription;
    private $rewrittenURL;
    private $imageURL;
    
    public function __construct($id, \stdClass $data) {
        $name = $data->name;
        $this->ps_id = $id;
        $this->active = true;
        $this->name = $name;
        $this->parentCategory = 'home';
        $this->rootCategory = 'home';
        $this->description = '';
        $this->metaTitle = $name;
        $this->metaKeywords = $name.(isset($data->move_damage_class->name)?', '.$data->move_damage_class->name:'');
        $this->metaDescription = '';
        $this->rewrittenURL = $name;
        $this->imageURL = $data->images;
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
        return $this->name;
    }

    public function getName() {
        return $this->name;
    }

    public function getParentCategory() {
        return $this->parentCategory;
    }

    public function getPsId() {
        return $this->ps_id;
    }

    public function getRewrittenURL() {
        return $this->rewrittenURL;
    }

    public function getRootCategory() {
        return $this->rootCategory;
    }

}
