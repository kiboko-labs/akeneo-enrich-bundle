<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

use Akeneo\Tool\Component\Localization\Model\TranslatableInterface;
use Doctrine\Common\Collections\Collection;

interface DescribedInterface extends TranslatableInterface
{
    /**
     * @param string $locale
     *
     * @return string
     */
    public function getDescription(?string $locale = null): ?string;

    /**
     * @param string $description
     * @param string $locale
     */
    public function setDescription(?string $description, ?string $locale = null);

    /**
     * @return Collection|DescribedTranslationInterface[]
     */
    public function getDescriptions(): Collection;

    /**
     * @return string
     */
    public function getDescriptionFallback(): string;

    /**
     * @param string $description
     */
    public function setDescriptionFallback(string $description);
}