<?php

namespace Quetzacoalt\PokeBundle\DataUpdater;

use Doctrine\DBAL\Exception\TableNotFoundException;
use Doctrine\ORM\EntityManager;
use Quetzacoalt\PokeBundle\Entity\Category;

class CategoryUpdater extends EntityManager implements PsUpdater
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
        $q = $this->em->createQuery('delete from '. Category::class);
        $q->execute();
        
        foreach ($sources as $source) {
            $cat = Category::createFromCategorySource($source);
            $this->add($cat, false);
        }
        $this->em->flush();
    }
    
    public function add(Category $cat, $flush = true)
    {
        $this->em->persist($cat);
        if ($flush) {
            $this->em->flush();
        }
    }
}
