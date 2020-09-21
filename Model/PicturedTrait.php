<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

use Akeneo\Tool\Component\FileStorage\Model\FileInfoInterface;
use Akeneo\Tool\Component\Localization\Model\TranslationInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait PicturedTrait
{
    /**
     * @var FileInfoInterface
     */
    protected $pictureFallback;

    /**
     * @param string $locale
     *
     * @return TranslationInterface|PicturedTranslationInterface
     */
    abstract public function getTranslation(?string $locale = null);

    /**
     * @return Collection|ArrayCollection|ArrayCollection|PicturedTranslationInterface[]
     */
    abstract public function getTranslations(): ArrayCollection;

    /**
     * @param string $locale
     *
     * @return FileInfoInterface
     */
    public function getPicture(?string $locale = null): ?FileInfoInterface
    {
        if (null === ($translation = $this->getTranslation($locale))) {
            return $this->pictureFallback;
        }

        if (!$translation instanceof PicturedTranslationInterface) {
            throw new \RuntimeException(
                strtr('Translation class %found% should implement %expected%.',
                    [
                        '%found%' => get_class($translation),
                        '%expected%' => PicturedTranslationInterface::class,
                    ]
                )
            );
        }

        return $translation->getPicture();
    }

    /**
     * @param FileInfoInterface $picture
     * @param string $locale
     */
    public function setPicture(?FileInfoInterface $picture, ?string $locale = null)
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

        if (!$translation instanceof PicturedTranslationInterface) {
            throw new \RuntimeException(
                strtr('Translation class %found% shoi-uld implement %expected%.',
                    [
                        '%found%' => get_class($translation),
                        '%expected%' => PicturedTranslationInterface::class,
                    ]
                )
            );
        }

        $translation->setPicture($picture);
    }

    /**
     * @return Collection|FileInfoInterface[]
     */
    public function getPictures(): Collection
    {
        $pictures = new ArrayCollection();
        if ($this->pictureFallback) {
            $pictures->offsetSet(null, $this->pictureFallback);
        }

        foreach ($this->getTranslations() as $translation) {
            $pictures->offsetSet($translation->getLocale(), $translation->getPicture());
        }

        return $pictures;
    }

    /**
     * @return FileInfoInterface
     */
    public function getPictureFallback(): ?FileInfoInterface
    {
        return $this->pictureFallback;
    }

    /**
     * @param FileInfoInterface $picture
     */
    public function setPictureFallback(?FileInfoInterface $picture)
    {
        $this->pictureFallback = $picture;
    }
}
