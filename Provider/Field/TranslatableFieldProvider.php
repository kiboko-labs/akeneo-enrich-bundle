<?php

namespace Kiboko\Bundle\EnrichBundle\Provider\Field;

use Akeneo\Pim\Structure\Component\Model\AttributeInterface;

class TranslatableFieldProvider
{
    /**
     * {@inheritdoc}
     */
    public function getField($attribute)
    {
        return 'kiboko-translatable-field';
    }

    /**
     * {@inheritdoc}
     */
    public function supports($element)
    {
        return $element instanceof AttributeInterface &&
            $element->getAttributeType() === 'pim_catalog_number' &&
            null !== $element->getNumberMin() &&
            null !== $element->getNumberMax();
    }
}
