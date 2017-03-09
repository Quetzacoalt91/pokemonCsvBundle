<?php
namespace Quetzacoalt\PokeBundle\Api;

class ApiResult
{
    private $_data;

    public function __construct($data)
    {
        $this->_data = $data;
    }
    
    public function __get($attr)
    {
        $this->expand($attr);

        $var = $this->_data->{$attr};

        if ($this->canBeExpanded($var)) {
            return new self($var);
        }
        return $var;
    }

    public function getRaw()
    {
        return $this->_data;
    }

    private function canArrayBeExpanded($var)
    {
        if (!is_array($var)) {
            return false;
        }
        foreach ($var as $value) {
            if ($this->canBeExpanded($value)) {
                return true;
            }
        }
        return false;
    }

    private function canBeExpanded($var)
    {
        if (!is_object($var)) {
            return false;
        }
        return !empty($var->url);
    }

    private function expand($attr)
    {
        global $kernel;
        $client = $kernel->getContainer()->get('poke.api.client');

        if ($this->canBeExpanded($this->_data)) {
            $this->_data = (object)array_merge((array)$this->_data, (array)$client->retrieve($this->_data->url)->getRaw());
            unset($this->_data->url);
        }

        if ($this->canBeExpanded($this->_data->{$attr})) {
            $this->_data->{$attr} = (object)array_merge((array)$this->_data->{$attr}, (array)$client->retrieve($this->_data->{$attr}->url)->getRaw());
            unset($this->_data->{$attr}->url);
        }

        if ($this->canArrayBeExpanded($this->_data->{$attr})) {
            foreach ($this->_data->{$attr} as $key => $value) {
                if ($this->canBeExpanded($value)) {
                    $this->_data->{$attr}[$key] = (object)array_merge((array)$this->_data->{$attr}[$key], (array)$client->retrieve($this->_data->{$attr}[$key]->url)->getRaw());
                    unset($this->_data->{$attr}[$key]->url);
                }
            }
        }
    }
}