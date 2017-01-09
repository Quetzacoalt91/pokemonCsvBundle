<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Quetzacoalt\PokeBundle\Api;

use GuzzleHttp\Client;
use Symfony\Component\Filesystem\Filesystem;

class ApiClient {
    private $client;
    private $cacheDir;
    private $domain;
    private $filesystem;
    private $apiToTranslator;
    
    public function __construct(Client $client, $cacheDir, $domain, ApiToTranslator $apiToTranslator)
    {
        $this->client = $client;
        $this->domain = $domain;
        $this->filesystem = new Filesystem;
        $this->cacheDir = $cacheDir.'/api/';
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
        $filename = $this->getCacheFilePath($path);
        if ($this->filesystem->exists($filename)) {
            return json_decode(file_get_contents($filename));
        }
        
        $response = $this->client->get($this->domain.$path)->getBody();

        $this->filesystem->dumpFile($filename, $response);
        return json_decode($response);
    }
    
    private function getCacheFilePath($path)
    {
        return rtrim($this->cacheDir.$path, '/').'.json';
    }
    
    private function retrieveFromUrl($url)
    {
        if (false === strpos($url, $this->domain)) {
            throw new \Exception("Potential security issue by requesting external URL ". $url);
        }
        $path = str_replace($this->domain, '', $url);
        return $this->retrieve($path);
    }
}
