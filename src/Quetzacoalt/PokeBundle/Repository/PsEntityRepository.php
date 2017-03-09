<?php

namespace Quetzacoalt\PokeBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PsEntityRepository extends EntityRepository
{
    public function findbyPsId($ps_id)
    {
        return $this->findOneBy(['ps_id' => $ps_id]);
    }

}
