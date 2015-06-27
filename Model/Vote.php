<?php

namespace Bitheater\RatingBundle\Model;

abstract class Vote
{
    /**
     * @var mixed
     */
    protected $voterId;

    /**
     * @var int
     */
    protected $value;

    /**
     * @var mixed
     */
    protected $resourceId;

    /**
     * @var string
     */
    protected $resourceKey;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getResourceId()
    {
        return $this->resourceId;
    }

    /**
     * @param mixed $resourceId
     */
    public function setResourceId($resourceId)
    {
        $this->resourceId = $resourceId;
    }

    /**
     * @return string
     */
    public function getResourceKey()
    {
        return $this->resourceKey;
    }

    /**
     * @param string $resourceKey
     */
    public function setResourceKey($resourceKey)
    {
        $this->resourceKey = $resourceKey;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue($value)
    {
        $this->value = (int)$value;
    }

    /**
     * @return mixed
     */
    public function getVoterId()
    {
        return $this->voterId;
    }

    /**
     * @param mixed $voterId
     */
    public function setVoterId($voterId)
    {
        $this->voterId = $voterId;
    }
}
