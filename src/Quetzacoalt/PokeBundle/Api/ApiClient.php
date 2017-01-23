<?php

namespace Quetzacoalt\PokeBundle\Api;

use GuzzleHttp\Client;
use Symfony\Component\Filesystem\Filesystem;

class ApiClient {
    private $client;
    private $cacheDir;
    private $domain;
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
        $response = $this->call($path);
         
        $results = !empty($response->results)?
                $response->results:
                $response;
        
        // Handle pagination
        if (!empty($response->next)) {
            $results = (object)array_merge((array)$results, (array)$this->retrieve($response->next));
        }
        
        if (!empty($response->count)) {
            // Load details
            foreach ($results as $key => $result) {
                if (!empty($result->url)) {
                    $results[$key] = (object)array_merge((array)$result, (array)$this->retrieveFromUrl($result->url));
                }
            }
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
        if (false === strpos($url, (string)$this->client->getConfig('base_uri'))) {
            throw new \Exception("Potential security issue by requesting external URL ". $url);
        }
        $path = str_replace((string)$this->client->getConfig('getConfig'), '', $url);
        return $this->retrieve($path);
    }
}
