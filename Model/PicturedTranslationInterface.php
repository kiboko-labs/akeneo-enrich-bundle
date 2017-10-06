<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

use Akeneo\Component\FileStorage\Model\FileInfoInterface;
use Akeneo\Component\Localization\Model\TranslationInterface;

interface PicturedTranslationInterface extends TranslationInterface
{
    /**
     * @param string $locale
     *
     * @return FileInfoInterface
     */
    public function getPicture();

    /**
     * @param FileInfoInterface $picture
     */
    public function setPicture(FileInfoInterface $picture = null);
}