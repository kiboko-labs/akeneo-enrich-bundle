<?php
/**
 * Created by PhpStorm.
 * User: mghoubali
 * Date: 03/10/2017
 * Time: 16:39
 */

namespace Kiboko\Bundle\EnrichBundle\Model;


use Akeneo\Component\Localization\Model\TranslatableInterface;
use Doctrine\Common\Collections\Collection;

interface DescribedInterface extends TranslatableInterface
{
    /**
     * @param string $locale
     *
     * @return string
     */
    public function getDescription($locale = null);

    /**
     * @param string $description
     * @param string $locale
     */
    public function setDescription($description, $locale = null);

    /**
     * @return Collection|DescribedTranslationInterface[]
     */
    public function getDescriptions();

    /**
     * @return string
     */
    public function getDescriptionFallback();

    /**
     * @param string $description
     */
    public function setDescriptionFallback($description);
}