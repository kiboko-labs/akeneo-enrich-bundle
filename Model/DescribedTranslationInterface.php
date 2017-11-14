<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

use Akeneo\Component\Localization\Model\TranslationInterface;

interface DescribedTranslationInterface extends TranslationInterface
{
    /**
     * @return string
     */
    public function getDescription(): ?string;

    /**
     * @param string $description
     */
    public function setDescription(?string $description);
}