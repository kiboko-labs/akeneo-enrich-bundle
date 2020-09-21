<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

use Akeneo\Tool\Component\FileStorage\Model\FileInfoInterface;
use Akeneo\Tool\Component\Localization\Model\TranslatableInterface;
use Doctrine\Common\Collections\Collection;

interface PicturedInterface extends TranslatableInterface
{
    /**
     * @param string $locale
     *
     * @return FileInfoInterface
     */
    public function getPicture(?string $locale = null): ?FileInfoInterface;

    /**
     * @param FileInfoInterface $picture
     * @param string $locale
     */
    public function setPicture(?FileInfoInterface $picture, ?string $locale = null);

    /**
     * @return Collection|FileInfoInterface[]
     */
    public function getPictures(): collection;

    /**
     * @return FileInfoInterface
     */
    public function getPictureFallback(): ?FileInfoInterface;

    /**
     * @param FileInfoInterface $picture
     */
    public function setPictureFallback(?FileInfoInterface $picture);

}