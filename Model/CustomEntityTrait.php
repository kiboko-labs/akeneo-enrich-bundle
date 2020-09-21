<?php

namespace Kiboko\Bundle\EnrichBundle\Model;

trait CustomEntityTrait
{
    use ReferenceDataTrait;

    /** @var \DateTimeInterface */
    protected $created;

    /** @var \DateTimeInterface */
    protected $updated;

    /**
     * {@inheritdoc}
     */
    public function getReference()
    {
        return $this->code;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    /**
     * @param \DateTimeInterface $created
     *
     * @return CustomEntityTrait
     */
    public function setCreated(\DateTimeInterface $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @param \DateTimeInterface $updated
     *
     * @return CustomEntityTrait
     */
    public function setUpdated(\DateTimeInterface $updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Returns the custom entity name used in the configuration
     * Used to map row actions on datagrid
     *
     * @return string
     */
    abstract public function getCustomEntityName(): string;

    /**
     * Returns the sort order
     *
     * @return string
     */
    public static function getSortOrderColumn(): string
    {
        return 'sortOrder';
    }
}