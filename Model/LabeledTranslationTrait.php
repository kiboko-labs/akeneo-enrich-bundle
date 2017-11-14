<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

trait LabeledTranslationTrait
{
    /**
     * @var string
     */
    private $label;

    /**
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(?string $label)
    {
        $this->label = $label;
    }
}