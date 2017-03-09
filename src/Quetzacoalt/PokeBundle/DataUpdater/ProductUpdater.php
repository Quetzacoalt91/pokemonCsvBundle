<?php

namespace Quetzacoalt\PokeBundle\DataUpdater;

use Doctrine\ORM\EntityManager;
use Quetzacoalt\PokeBundle\Entity\Product;

class ProductUpdater extends EntityManager implements PsUpdater
{
    /**
     * @var Doctrine\ORM\EntityManager 
     */
    protected $em;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }
    
    public function addFromSources(array $sources)
    {
        // Clean first
        $q = $this->em->createQuery('delete from '. Product::class);
        $q->execute();
        
        foreach ($sources as $source) {
            $cat = Product::createFromProductSource($source);
            $this->add($cat, false);
        }
        $this->em->flush();
    }
    
    public function add(Product $cat, $flush = true)
    {
        $this->em->persist($cat);
        if ($flush) {
            $this->em->flush();
        }
    }
}
