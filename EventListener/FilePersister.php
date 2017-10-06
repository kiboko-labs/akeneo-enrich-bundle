<?php

namespace Kiboko\Bundle\EnrichBundle\EventListener;

use Akeneo\Component\FileStorage\Model\FileInfoInterface;
use Kiboko\Bundle\EnrichBundle\Entity\Translatable;
use Kiboko\Bundle\EnrichBundle\Model\PicturedInterface;
use Kiboko\Bundle\EnrichBundle\Model\PicturedTranslationInterface;
use League\Flysystem\Filesystem;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class FilePersister
{
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @param GenericEvent $event
     */
    public function onAkeneoStoragePostsave(GenericEvent $event)
    {
        $object = $event->getSubject();

        if (!$object instanceof PicturedInterface) {
            return;
        }

        $picture = $object->getPictureFallback();
        if ($picture instanceof FileInfoInterface &&
            $picture->getUploadedFile() !== null
        ) {
            $this->persistFile($picture, $picture->getUploadedFile());
        }

        /**
         * @var $translatableTranslation PicturedTranslationInterface
         */
        foreach ($object->getTranslations() as $translatableTranslation) {
            $picture = $translatableTranslation->getPicture();

            if ($picture instanceof FileInfoInterface &&
                $picture->getUploadedFile() !== null
            ) {
                $this->persistFile($picture, $picture->getUploadedFile());
            }
        }
    }

    /**
     * @param FileInfoInterface $picture
     * @param UploadedFile $file
     */
    private function persistFile(FileInfoInterface $picture, UploadedFile $file)
    {
        $resource = fopen($file->getRealPath(), 'r');
        $this->filesystem->writeStream($picture->getKey(), $resource);
    }
}