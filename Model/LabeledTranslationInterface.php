<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

use Akeneo\Component\Localization\Model\TranslationInterface;

interface LabeledTranslationInterface extends TranslationInterface
{
    /**
     * @return string
     */
    public function getLabel(): ?string;

    /**
     * @param string $label
     */
    public function setLabel(?string $label);

}