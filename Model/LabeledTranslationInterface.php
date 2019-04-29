<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

use Akeneo\Tool\Component\Localization\Model\TranslationInterface;

/**
 * Interface LabeledTranslationInterface
 * @package Kiboko\Bundle\EnrichBundle\Model
 */
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