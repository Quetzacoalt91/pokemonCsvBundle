<?php

namespace Quetzacoalt\PokeBundle\Api;

use Symfony\Component\Translation\TranslatorInterface;

class ApiToTranslator
{
    protected $translator;
    
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    
    public function addToTranslator($data, $domain = 'pokemon')
    {
        if (is_array($data)) {
            foreach($data as $singleData) {
                $this->add($singleData, $domain);
            }
        } else {
            $this->add($data, $domain);
        }
    }
    
    protected function add($data, $domain)
    {
        if (!isset($data->names)) {
            return;
        }
        foreach ($data->names as $translatedData) {
            $locale = $translatedData->language->name;
            
            $this->translator->getCatalogue($locale)->set(
                $data->name,
                $translatedData->name,
                $domain);
        }
    }
}
