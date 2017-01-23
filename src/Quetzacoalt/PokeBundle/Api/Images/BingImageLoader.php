<?php

namespace Quetzacoalt\PokeBundle\Api\Images;

use GuzzleHttp\Client;

class BingImageLoader implements ApiImageInterface
{
    /**
     * @var Client 
     */
    protected $client;
    
    /**
     * @var String
     */
    protected $api_key;
    
    /**
     * @var string
     */
    protected $additionnal_query;
    
    /**
     * 
     * @param Client $client
     * @param String $api_key
     */
    public function __construct(Client $client, $api_key)
    {
        $this->client = $client;
        $this->api_key = $api_key;
        $this->additionnal_query = ' pokemon';
    }
    
    public function search($term, array $options = array())
    {
        if (!array_key_exists('max_results', $options)) {
            $options['max_results'] = 5;
        }
        
        return $this->simplifyResults(
            json_decode(
                $this->client->post('', array(
                    'headers' => array(
                        //'Content-Type' => 'multipart/form-data',
                        'Ocp-Apim-Subscription-Key' => $this->api_key,
                    ),
                    'query' => array(
                        'count' => (int)$options['max_results'],
                        'q' => $term.$this->additionnal_query
                    ),
            ))->getBody()));
    }
    
    protected function simplifyResults($results)
    {
        $finalUrls = array();
        $funcToCall = function(
                \Psr\Http\Message\RequestInterface $request,
                \Psr\Http\Message\ResponseInterface $response,
                \Psr\Http\Message\UriInterface $uri) use (&$finalUrls) {
                    $finalUrls[] = (string)$uri;
                };
                
        
        foreach ($results->value as $result) {
            try {
                // We need this part to know the image location after
                // redirection from Bing service
                $this->client->get($result->contentUrl, array(
                    'allow_redirects' => array(
                        'on_redirect' => $funcToCall,
                    ),
                ));
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                // continue;
            }
        }
        
        return $finalUrls;
    }
}
