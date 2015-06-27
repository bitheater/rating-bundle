<?php

namespace Bitheater\RatingBundle\Event;

use Bitheater\RatingBundle\VoteEvents;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DoctrineVoteSubscriber implements EventSubscriberInterface
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            VoteEvents::VOTE_ADDED => [
                ['onVoteAdded', -100],
            ]
        ];
    }

    /**
     * @param VoteAddedEvent $event
     */
    public function onVoteAdded(VoteAddedEvent $event)
    {
        $this->objectManager->persist($event->getVote());
    }
}
