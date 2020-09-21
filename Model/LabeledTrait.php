<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

use Akeneo\Tool\Component\Localization\Model\TranslationInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait LabeledTrait
{
    /**
     * @var string
     */
    protected $labelFallback;

    /**
     * @param string $locale
     *
     * @return TranslationInterface|LabeledTranslationInterface
     */
    abstract public function getTranslation(?string $locale = null);

    /**
     * @return ArrayCollection|LabeledTranslationInterface[]
     */
    abstract public function getTranslations(): ArrayCollection;

    /**
     * @param string $locale
     *
     * @return string
     */
    public function getLabel(?string $locale = null): ?string
    {
        if (null === ($translation = $this->getTranslation($locale))) {
            return $this->labelFallback;
        }

        if (!$translation instanceof LabeledTranslationInterface) {
            throw new \RuntimeException(
                strtr('Translation class %found% should implement %expected%.',
                    [
                        '%found%' => get_class($translation),
                        '%expected%' => LabeledTranslationInterface::class,
                    ]
                )
            );
        }

        if ('' === ($label = $translation->getLabel())) {
            return $this->labelFallback;
        }

        return $label;
    }

    /**
     * @param string $label
     * @param string $locale
     */
    public function setLabel(?string $label, ?string $locale = null)
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

        if (!$translation instanceof LabeledTranslationInterface) {
            throw new \RuntimeException(
                strtr('Translation class %found% shoi-uld implement %expected%.',
                    [
                        '%found%' => get_class($translation),
                        '%expected%' => LabeledTranslationInterface::class,
                    ]
                )
            );
        }

        $translation->setLabel($label);
    }

    /**
     * @return Collection|LabeledTranslationInterface
     */
    public function getLabels(): Collection
    {
        $labels = new ArrayCollection();
        if ($this->labelFallback) {
            $labels->offsetSet(null, $this->labelFallback);
        }

        foreach ($this->getTranslations() as $translation) {
            $labels->offsetSet($translation->getLocale(), $translation->getLabel());
        }

        return $labels;
    }

    /**
     * @return string
     */
    public function getLabelFallback(): ?string
    {
        return $this->labelFallback;
    }

    /**
     * @param string $labelFallback
     */
    public function setLabelFallback(string $labelFallback)
    {
        $this->labelFallback = $labelFallback;
    }
}
