<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

trait DescribedTranslationTrait
{
    /**
     * @var string
     */
    private $description;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}