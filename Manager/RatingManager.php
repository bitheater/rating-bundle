<?php

namespace Bitheater\RatingBundle\Manager;

use Bitheater\RatingBundle\Manager\Exception\AlreadyVotedException;
use Bitheater\RatingBundle\Model\Vote;

interface RatingManager
{
    /**
     * Adds a new vote. It can throw an exception if the user already voted
     * for that resource id
     * @param Vote $vote
     * @throws AlreadyVotedException
     */
    public function add(Vote $vote);

    /**
     * Gets all votes for a specific resource key
     * @param string $key
     * @return Vote[]
     */
    public function findForResourceKey($key);

    /**
     * Gets all votes for a specific resource key and voter
     * @param string $key
     * @param mixed $voterId
     * @return Vote[]
     */
    public function findForResourceKeyByVoter($key, $voterId);

    /**
     * Finds the vote given by a voter for a specific resource
     * @param string $key
     * @param mixed $resourceId
     * @param mixed $voterId
     * @return Vote
     */
    public function findForResourceByVoter($key, $resourceId, $voterId);

    /**
     * Gets the average rating for a resource
     * @param string $key
     * @param mixed $resourceId
     * @return float
     */
    public function findAverageFor($key, $resourceId);
}
