<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

use Akeneo\Component\Localization\Model\TranslationInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait DescribedTrait
{
    /**
     * @var string
     */
    protected $descriptionFallback;

    /**
     * @param string $locale
     *
     * @return TranslationInterface|DescribedTranslationInterface
     */
    abstract public function getTranslation(?string $locale = null);

    /**
     * @return Collection|ArrayCollection|DescribedTranslationInterface[]
     */
    abstract public function getTranslations(): ArrayCollection;

    /**
     * @param string $locale
     *
     * @return string
     */
    public function getDescription(?string $locale = null): ?string
    {
        if (null === ($translation = $this->getTranslation($locale))) {
            return $this->descriptionFallback;
        }

        if (!$translation instanceof DescribedTranslationInterface) {
            throw new \RuntimeException(
                strtr('Translation class %found% should implement %expected%.',
                    [
                        '%found%' => get_class($translation),
                        '%expected%' => DescribedTranslationInterface::class,
                    ]
                )
            );
        }

        if ('' === ($description = $translation->getDescription())) {
            return $this->descriptionFallback;
        }

        return $description;
    }

    /**
     * @param string $description
     * @param string $locale
     */
    public function setDescription(?string $description, ?string $locale = null)
    {
        if (null === ($translation = $this->getTranslation($locale))) {
            throw new \RuntimeException(
                strtr('Missing translation for locale %locale%.',
                    [
                        '%locale%' => $locale,
                    ]
                )
            );
        }

        if (!$translation instanceof DescribedTranslationInterface) {
            throw new \RuntimeException(
                strtr('Translation class %found% shoi-uld implement %expected%.',
                    [
                        '%found%' => get_class($translation),
                        '%expected%' => DescribedTranslationInterface::class,
                    ]
                )
            );
        }

        $translation->setDescription($description);
    }

    /**
     * @return Collection|DescribedTranslationInterface[]
     */
    public function getDescriptions(): Collection
    {
        $descriptions = new ArrayCollection();
        if ($this->descriptionFallback) {
            $descriptions->offsetSet(null, $this->descriptionFallback);
        }

        foreach ($this->getTranslations() as $translation) {
            $descriptions->offsetSet($translation->getLocale(), $translation->getDescription());
        }

        return $descriptions;
    }

    /**
     * @return string
     */
    public function getDescriptionFallback(): string
    {
        return $this->descriptionFallback;
    }

    /**
     * @param string $description
     */
    public function setDescriptionFallback(string $description)
    {
        $this->descriptionFallback = $description;
    }
}
