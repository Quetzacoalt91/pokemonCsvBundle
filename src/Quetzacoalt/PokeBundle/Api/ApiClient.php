<?php

namespace Quetzacoalt\PokeBundle\Api;

use GuzzleHttp\Client;
use Symfony\Component\Filesystem\Filesystem;

class ApiClient {
    private $client;
    private $filesystem;
    private $apiToTranslator;
    
    public function __construct(Client $client, ApiToTranslator $apiToTranslator)
    {
        $this->client = $client;
        $this->filesystem = new Filesystem;
        $this->apiToTranslator = $apiToTranslator;
    }
    
    public function retrieve($path)
    {
        $response = $this->retrieveFromUrl($path);
        if (!empty($response->results)) {
                $results = array_map(function($item) {return new ApiResult($item);}, $response->results);
        } else {
                $results = new ApiResult($response);
        }
        
        // Handle pagination
        if (!empty($response->next)) {
            $results = array_merge((array)$results, (array)$this->retrieve($response->next));
        }
        
        $this->apiToTranslator->addToTranslator($results);
        
        return $results;
    }
    
    public function call($path)
    {
        $response = $this->client->get($path)->getBody();
        return json_decode($response);
    }
    
    private function retrieveFromUrl($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) && false === strpos($url, (string)$this->client->getConfig('base_uri'))) {
            throw new \Exception("Potential security issue by requesting external URL ". $url);
        }
        $path = str_replace((string)$this->client->getConfig('getConfig'), '', $url);
        
        $response = $this->call($path);

      
        return $response;
    }
}
