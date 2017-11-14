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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(?string $description)
    {
        $this->description = $description;
    }
}