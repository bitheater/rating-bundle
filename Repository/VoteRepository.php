<?php

namespace Bitheater\RatingBundle\Repository;

interface VoteRepository
{
    public function findForResourceKey($key);

    public function findForResourceKeyByVoter($key, $voterId);

    public function findForResourceByVoter($key, $resourceId, $voterId);

    public function findAverageForResourceKey($key, $resourceId);
}
