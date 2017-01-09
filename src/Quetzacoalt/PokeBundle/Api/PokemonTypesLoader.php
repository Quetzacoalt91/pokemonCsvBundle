<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Quetzacoalt\PokeBundle\Api;

use Quetzacoalt\PokeBundle\Api\ApiClient;
use Quetzacoalt\PokeBundle\Entity\Pokemon\PokemonCategory;

class PokemonTypesLoader implements ApiLoaderInterface {
    public $apiClient;
    
    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        $this->path = 'type/';
    }

    public function load()
    {
        $types = array();
        foreach ($this->apiClient->retrieve($this->path) as $data) {
            $types[] = (new PokemonCategory($data->id, $data));
        }
        return $types;
    }
}
