<?php

namespace Bitheater\RatingBundle\Manager;

use Bitheater\RatingBundle\Event\VoteAddedEvent;
use Bitheater\RatingBundle\Manager\Exception\AlreadyVotedException;
use Bitheater\RatingBundle\Model\Vote;
use Bitheater\RatingBundle\Repository\VoteRepository;
use Bitheater\RatingBundle\VoteEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DefaultRatingManager implements RatingManager
{
    /**
     * @var VoteRepository
     */
    private $voteRepository;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param EventDispatcherInterface $dispatcher
     * @param VoteRepository $voteRepository
     */
    public function __construct(
        EventDispatcherInterface $dispatcher,
        VoteRepository $voteRepository
    )
    {
        $this->eventDispatcher = $dispatcher;
        $this->voteRepository = $voteRepository;
    }

    public function add(Vote $vote)
    {
        $voteInstance = $this->findForResourceByVoter(
            $vote->getResourceKey(),
            $vote->getResourceId(),
            $vote->getVoterId()
        );

        if ($voteInstance) {
            throw new AlreadyVotedException(
                sprintf(
                    'User %s has already voted for resourceId %s (%s)',
                    $vote->getVoterId(),
                    $vote->getResourceId(),
                    $vote->getResourceKey()
                )
            );
        }

        $this->eventDispatcher->dispatch(
            VoteEvents::VOTE_ADDED,
            new VoteAddedEvent($vote)
        );
    }

    public function findForResourceKey($key)
    {
        return $this
            ->voteRepository
            ->findForResourceKey($key);
    }

    public function findForResourceKeyByVoter($key, $voterId)
    {
        return $this
            ->voteRepository
            ->findForResourceKeyByVoter($key, $voterId);
    }

    public function findForResourceByVoter($key, $resourceId, $voterId)
    {
        return $this
            ->voteRepository
            ->findForResourceByVoter($key, $resourceId, $voterId);
    }

    public function findAverageFor($key, $resourceId)
    {
        return $this
            ->voteRepository
            ->findAverageForResourceKey($key, $resourceId);
    }
}
