<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

trait LabelledTranslationTrait
{
    /**
     * @var string
     */
    private $label;

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
}