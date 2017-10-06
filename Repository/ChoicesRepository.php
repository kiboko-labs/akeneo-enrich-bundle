<?php

namespace Kiboko\Bundle\EnrichBundle\Repository;

use Kiboko\Bundle\EnrichBundle\Model\MappedOption;
use Doctrine\ORM\EntityManager;


class ChoicesRepository
{
    /**
     * @var EntityManager
     */
    protected $entityManager;
    /**
     * @var string
     */
    protected $className;

    /**
     * @param EntityManager $entityManager
     * @param string        $className
     */
    public function __construct(EntityManager $entityManager, $className)
    {
        $this->entityManager = $entityManager;
        $this->className = $className;
    }

    /**
     * Get choices from entity
     *
     * @return array
     */
    public function getChoices()
    {
        $entityRepository = $this->entityManager->getRepository($this->className);
        $values = $entityRepository->findAll();
        $choices = [];

        /** @var MappedOption $value */
        foreach ($values as $value) {
            $choices[$value->getId()] = $value->getLabel();
        }

        return $choices;
    }
}
