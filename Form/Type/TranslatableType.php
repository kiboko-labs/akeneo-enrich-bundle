<?php

namespace Kiboko\Bundle\EnrichBundle\Form\Type;

use Kiboko\Bundle\EnrichBundle\Form\Subscriber\TranslatableFieldSubscriber;
use Akeneo\UserManagement\Bundle\Context\UserContext;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\InvalidConfigurationException;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TranslatableType extends AbstractType
{
    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var UserContext
     */
    protected $userContext;

    /**
     * @param ValidatorInterface $validator
     * @param UserContext $userContext
     */
    public function __construct(ValidatorInterface $validator, UserContext $userContext)
    {
        $this->validator = $validator;
        $this->userContext = $userContext;
    }

    /**
     * {@inheritdoc}
     * @throws \Akeneo\Platform\Bundle\UIBundle\Exception\MissingOptionException
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // TODO : use resolver to do that, see http://symfony.com/doc/current/components/options_resolver.html
        if (!class_exists($options['entity_class'])) {
            throw new InvalidConfigurationException('unable to find entity class');
        }

        if (!class_exists($options['translation_class'])) {
            throw new InvalidConfigurationException('unable to find translation class');
        }

        if (!$options['field']) {
            throw new InvalidConfigurationException('must provide a field');
        }

        if (!is_array($options['required_locale'])) {
            throw new InvalidConfigurationException('required locale(s) must be an array');
        }

        $subscriber = new TranslatableFieldSubscriber(
            $builder->getFormFactory(),
            $this->validator,
            $this->userContext,
            $options
        );
        $builder->addEventSubscriber($subscriber);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setRequired(
            [
                'entity_class',
                'translation_class',
                'field',
                'required_locale',
            ]
        );
        $resolver->setDefaults(
            [
                'translation_class' => false,
                'entity_class'      => false,
                'field'             => false,
                'locales'           => $this->userContext->getUserLocaleCodes(),
                'user_locale'       => $this->userContext->getUiLocale(),
                'required_locale'   => [],
                'widget'            => 'text',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'kiboko_translatable_field';
    }
}
