<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

use Doctrine\Common\Collections\Collection;
use Pim\Bundle\CustomEntityBundle\Entity\TranslatableTrait;
use Symfony\Component\PropertyAccess\PropertyAccessorBuilder;

trait TranslatableCustomEntityTrait
{
    use ReferenceDataTrait;

    /**
     * @return string
     */
    abstract public static function getFallbackLabelProperty();

    /**
     * @return string
     */
    public function __toString(): string
    {
        if (null !== ($translation = $this->getTranslation())) {
            if (null !== ($labelProperty = static::getLabelProperty())) {
                $accessor = (new PropertyAccessorBuilder())->getPropertyAccessor();
                $label = $accessor->getValue($translation, $labelProperty);

                if ('' !== $label && null !== $label) {
                    return $label;
                }
            }
        }

        if (null !== ($labelProperty = static::getFallbackLabelProperty())) {
            $accessor = (new PropertyAccessorBuilder())->getPropertyAccessor();
            $label = $accessor->getValue($this, $labelProperty);

            if ('' !== $label && null !== $label) {
                return $label;
            }
        }

        return sprintf('[%s]', $this->code);
    }
}
