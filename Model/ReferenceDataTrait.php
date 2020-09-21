<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

use Symfony\Component\PropertyAccess\PropertyAccessorBuilder;

trait ReferenceDataTrait
{
    /** @var mixed */
    protected $id;

    /** @var string */
    protected $code;

    /** @var int */
    protected $sortOrder = 1;

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * {@inheritdoc}
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param $sortOrder
     *
     * @return ReferenceDataInterface
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * @return string
     */
    abstract public static function getLabelProperty();

    /**
     * @return string
     */
    public function __toString()
    {
        if (null !== ($labelProperty = static::getLabelProperty())) {
            $accessor = (new PropertyAccessorBuilder())->getPropertyAccessor();
            $label = $accessor->getValue($this, $labelProperty);

            if ('' !== $label && null !== $label) {
                return $label;
            }
        }

        return sprintf('[%s]', $this->code);
    }
}