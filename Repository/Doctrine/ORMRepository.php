<?php

namespace Bitheater\RatingBundle\Repository\Doctrine;

use Bitheater\RatingBundle\Repository\VoteRepository;
use Doctrine\ORM\EntityRepository;

class ORMRepository extends EntityRepository implements VoteRepository
{
    public function findForResourceKey($key)
    {
        return $this->findBy([
            'resourceKey' => $key
        ]);
    }

    public function findForResourceKeyByVoter($key, $voterId)
    {
        return $this->findBy([
            'resourceKey' => $key,
            'voterId' => $voterId
        ]);
    }

    public function findForResourceByVoter($key, $resourceId, $voterId)
    {
        return $this->findBy([
            'resourceKey' => $key,
            'voterId' => $voterId,
            'resourceId' => $resourceId
        ]);
    }

    public function findAverageForResourceKey($key, $resourceId)
    {
        $dql = sprintf(
            'SELECT AVG(e.value) FROM %s e WHERE e.resourceKey = :resourceKey AND e.resourceId = :resourceId',
            $this->getEntityName()
        );

        $query = $this
            ->getEntityManager()
            ->createQuery($dql)
            ->setParameter('resourceKey', $key)
            ->setParameter('resourceId', $resourceId);

        return $query->getSingleScalarResult();
    }
}
