<?php


namespace Quetzacoalt\PokeBundle\Entity\Pokemon;

use Quetzacoalt\PokeBundle\Entity\Category;

class PokemonCategory extends Category
{
    // Documentation https://pokeapi.co/docsv2/#types
    
    public function __construct($id, \stdClass $data)
    {
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
        $this->imageURL = implode(',', $data->images);
    }
}
