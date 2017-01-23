<?php

namespace Quetzacoalt\PokeBundle\Api\Images;

interface ApiImageInterface
{
    public function search($term, array $options);
}
