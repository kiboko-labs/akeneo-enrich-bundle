<?php

namespace Kiboko\Bundle\EnrichBundle\Model;


use Akeneo\Component\FileStorage\Model\FileInfoInterface;
use Akeneo\Component\Localization\Model\TranslatableInterface;
use Doctrine\Common\Collections\Collection;

interface PicturedInterface extends TranslatableInterface
{
    /**
     * @param string $locale
     *
     * @return FileInfoInterface
     */
    public function getPicture($locale = null);

    /**
     * @param FileInfoInterface $picture
     * @param string $locale
     */
    public function setPicture(FileInfoInterface $picture, $locale = null);

    /**
     * @return Collection|FileInfoInterface[]
     */
    public function getPictures();

    /**
     * @return FileInfoInterface
     */
    public function getPictureFallback();

    /**
     * @param FileInfoInterface $picture
     */
    public function setPictureFallback(FileInfoInterface $picture = null);

}