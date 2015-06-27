<?php

namespace Bitheater\RatingBundle\Event;

use Bitheater\RatingBundle\Model\Vote;
use Symfony\Component\EventDispatcher\Event;

class VoteAddedEvent extends Event
{
    /**
     * @var Vote
     */
    private $vote;

    /**
     * @param Vote $vote
     */
    public function __construct(Vote $vote)
    {
        $this->vote = $vote;
    }

    /**
     * @return Vote
     */
    public function getVote()
    {
        return $this->vote;
    }
}
