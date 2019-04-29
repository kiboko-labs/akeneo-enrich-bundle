<?php

namespace Kiboko\Bundle\EnrichBundle\Form\Type;

use Akeneo\Tool\Bundle\FileStorageBundle\Form\Type\FileInfoType;
use Symfony\Component\Form\FormBuilderInterface;

class MediaType extends FileInfoType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add(
                'removed',
                'checkbox',
                [
                    'required' => false,
                    'label'    => 'Remove media',
                ]
            )
            ->add('id', 'hidden');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'kiboko_enrich_media';
    }
}