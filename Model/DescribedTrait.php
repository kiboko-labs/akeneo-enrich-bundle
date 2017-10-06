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
     * @return DescribedTranslationInterface
     */
    abstract public function getTranslation($locale = null);

    /**
     * @return Collection|DescribedTranslationInterface[]
     */
    abstract public function getTranslations();

    /**
     * @param string $locale
     *
     * @return string
     */
    public function getDescription($locale = null)
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
    public function setDescription($description, $locale = null)
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
    public function getDescriptions()
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
    public function getDescriptionFallback()
    {
        return $this->descriptionFallback;
    }

    /**
     * @param string $description
     */
    public function setDescriptionFallback($description)
    {
        $this->descriptionFallback = $description;
    }
}
