<?php
// src/Repository/LocalisationcompetitionRepository.php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\Echellecompetition;
use Psr\Log\LoggerInterface;

class LocalisationcompetitionRepository extends EntityRepository
{
    public function findLocalisationFromEchelle(Echellecompetition $echelleCompetition)
    {
        $echelleType = $echelleCompetition->getEchcomType();
        return $this->createQueryBuilder('l')
                    ->where("l.loccomType = ?1")
                    ->setParameter(1, $echelleType)
                    ->getQuery()
                    ->getResult();
    }
}