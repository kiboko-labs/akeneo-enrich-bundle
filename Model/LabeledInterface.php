<?php
/**
 * Created by PhpStorm.
 * User: mghoubali
 * Date: 03/10/2017
 * Time: 16:37
 */

namespace Kiboko\Bundle\EnrichBundle\Model;

use Akeneo\Component\Localization\Model\TranslatableInterface;
use Doctrine\Common\Collections\Collection;

interface LabeledInterface extends TranslatableInterface
{
    /**
     * @param string $locale
     *
     * @return string
     */
    public function getLabel($locale = null);

    /**
     * @param string $label
     * @param string $locale
     */
    public function setLabel($label, $locale = null);

    /**
     * @return Collection|LabeledTranslationInterface[]
     */
    public function getLabels();

    /**
     * @return string
     */
    public function getLabelFallback();

    /**
     * @param string $labelFallback
     */
    public function setLabelFallback(string $labelFallback);

}