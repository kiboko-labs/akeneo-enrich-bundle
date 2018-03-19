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
    public function getLabel(?string $locale = null): ?string;

    /**
     * @param string $label
     * @param string $locale
     */
    public function setLabel(?string $label, ?string $locale = null);

    /**
     * @return Collection|LabeledTranslationInterface[]
     */
    public function getLabels(): Collection;

    /**
     * @return string
     */
    public function getLabelFallback(): ?string;

    /**
     * @param string $labelFallback
     */
    public function setLabelFallback(string $labelFallback);
}