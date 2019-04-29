<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

use Akeneo\Tool\Component\FileStorage\Model\FileInfoInterface;

trait PicturedTranslationTrait
{
    /**
     * @var FileInfoInterface
     */
    private $picture;

    /**
     * @return FileInfoInterface
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param FileInfoInterface $picture
     */
    public function setPicture(FileInfoInterface $picture = null)
    {
        $this->picture = $picture;
    }
}