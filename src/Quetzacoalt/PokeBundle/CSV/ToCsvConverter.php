<?php

namespace Quetzacoalt\PokeBundle\CSV;

use Symfony\Component\Filesystem\Filesystem;

class ToCsvConverter
{
    protected $destinationPath = '';
    protected $separator = ';';
    protected $enclosure = '"';
    
    public function __construct($destinationPath)
    {
        $this->destinationPath = $destinationPath;
    }
    
    public function export(array $entities)
    {
        $this->checkFolder();
        $header = null;
        $filename = (new \ReflectionClass($entities[0]))->getShortName();
        
        $fp = fopen($this->destinationPath.$filename.'.csv', 'w+');

        foreach ($entities as $entity) {
            $attributes = $this->updateIdField(get_object_vars($entity));
            if (null === $header) {
                $header = $this->getHeader($attributes);
                fputcsv($fp, $header, $this->separator, $this->enclosure);
            }

            fputcsv($fp, $attributes, $this->separator, $this->enclosure);
        }

        fclose($fp);
    }
    
    protected function checkFolder()
    {
        $filesystem = new Filesystem();
        $filesystem->mkdir($this->destinationPath);
    }
    
    protected function getHeader(array $attributes)
    {
        return array_keys($attributes);
        
    }
    
    protected function updateIdField (array $attributes)
    {
        if (array_key_exists('ps_id', $attributes)) {
            $attributes = array_merge(array('id' => $attributes['ps_id']), $attributes);
            unset($attributes['ps_id']);
        }
        return $attributes;
    }
}
