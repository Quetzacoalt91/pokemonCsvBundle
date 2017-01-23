<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Quetzacoalt\PokeBundle\Api;

use Quetzacoalt\PokeBundle\Api\ApiClient;
use Quetzacoalt\PokeBundle\Api\Images\ApiImageInterface;
use Quetzacoalt\PokeBundle\Entity\Pokemon\PokemonCategory;

class PokemonTypesLoader implements ApiLoaderInterface {
    /**
     * @var ApiClient
     */
    protected $apiClient;
    
    /**
     * @var ApiImageInterface 
     */
    protected $apiImageClient;
    
    public function __construct(ApiClient $apiClient, ApiImageInterface $apiImageClient)
    {
        $this->apiClient = $apiClient;
        $this->apiImageClient = $apiImageClient;
        $this->path = 'type/';
    }

    public function load()
    {
        $types = array();
        foreach ($this->apiClient->retrieve($this->path) as $data) {
            $data->images = implode(',', $this->apiImageClient->search(
                            $data->name, array('max_results' => 1)));
            $types[] = (new PokemonCategory($data->id, $data));
        }
        return $types;
    }
}
