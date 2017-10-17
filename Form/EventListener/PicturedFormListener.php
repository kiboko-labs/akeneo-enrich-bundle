<?php

namespace Kiboko\Bundle\EnrichBundle\Form\EventListener;

use Akeneo\Component\FileStorage\Model\FileInfoInterface;

use Kiboko\Bundle\EnrichBundle\Model\PicturedInterface;
use Kiboko\Bundle\EnrichBundle\Model\PicturedTranslationInterface;
use Kiboko\Bundle\EnrichBundle\Utils\FileInfo;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PicturedFormListener implements EventSubscriberInterface
{
    /**
     * @var FileInfo
     */
    private $utils;

    /**
     * FormListener constructor.
     *
     * @param FileInfo $utils
     */
    public function __construct(FileInfo $utils)
    {
        $this->utils = $utils;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SUBMIT => 'postSubmit'
        ];
    }

    /**
     * @param FormEvent $event
     */
    public function postSubmit(FormEvent $event)
    {
        $pictured = $event->getData();
        if (!$pictured instanceof PicturedInterface) {
            return;
        }

        $pictureFile = $pictured->getPictureFallback();
        if ($pictureFile instanceof FileInfoInterface) {
            if ($pictureFile->isRemoved()) {
                $pictured->setPictureFallback(null);
            } else {
                $pictured->setPictureFallback(
                    $this->utils->enrichImageFile($pictureFile)
                );
            }
        } else {
            $pictured->setPictureFallback(null);
        }

        /** @var PicturedTranslationInterface $pictureTranslation */
        foreach ($pictured->getTranslations() as $pictureTranslation) {
            $pictureFile = $pictureTranslation->getPicture();

            if ($pictureFile instanceof FileInfoInterface) {
                if ($pictureFile->isRemoved()) {
                    $pictureTranslation->setPicture(null);
                } else {
                    $pictureTranslation->setPicture(
                        $this->utils->enrichImageFile($pictureFile)
                    );
                }
            } else {
                $pictureTranslation->setPicture(null);
            }
        }
    }
}
