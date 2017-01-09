<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Quetzacoalt\PokeBundle\Entity\Source;

abstract class CategorySource {
    
    public function getPsId(){}
    
    public function getActive(){}
    public function getName(){}
    public function getParentCategory(){}
    public function getRootCategory(){}
    public function getDescription(){}
    public function getMetaTitle(){}
    public function getMetaKeywords(){}
    public function getMetaDescription(){}
    public function getRewrittenUrl(){}
    public function getImageUrl(){}
}
