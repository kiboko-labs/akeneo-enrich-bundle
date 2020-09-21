<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

use Akeneo\Tool\Component\FileStorage\Model\FileInfoInterface;
use Akeneo\Tool\Component\Localization\Model\TranslationInterface;

/**
 * Interface PicturedTranslationInterface
 * @package Kiboko\Bundle\EnrichBundle\Model
 */
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