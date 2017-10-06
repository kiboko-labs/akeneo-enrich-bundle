<?php

namespace Kiboko\Bundle\EnrichBundle\Utils;

use Akeneo\Component\FileStorage\FileInfoFactoryInterface;
use Akeneo\Component\FileStorage\Model\FileInfoInterface;
use Pim\Component\Catalog\FileStorage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileInfoUtils
 * @package Kiboko\Bundle\EnrichBundle\Utils
 *
 * Regarding a FileInfo entity, enrich it using his own UploadedFile property
 */
final class FileInfoUtils
{
    private $fileInfoFactory;

    public function __construct(FileInfoFactoryInterface $fileInfoFactory)
    {
        $this->fileInfoFactory = $fileInfoFactory;
    }

    /**
     * @param FileInfoInterface $image
     *
     * @return FileInfoInterface
     */
    public function enrichImageFile(FileInfoInterface $image)
    {
        $uploadedFile = $image->getUploadedFile();

        if ($uploadedFile === null) {
            return $image;
        }

        return $this->createFileInfo($uploadedFile);
    }

    /**
     * @param UploadedFile|null $uploadedFile
     *
     * @return FileInfoInterface
     */
    public function createFileInfo(UploadedFile $uploadedFile)
    {
        $fileInfo = $this->fileInfoFactory->createFromRawFile($uploadedFile, FileStorage::CATALOG_STORAGE_ALIAS);
        $fileInfo->setUploadedFile($uploadedFile);

        return $fileInfo;
    }
}