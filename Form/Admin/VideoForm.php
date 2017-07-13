<?php

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\VideoBundle\Form\Admin;

use Mindy\Bundle\AdminBundle\Form\Type\ButtonsType;
use Mindy\Bundle\VideoBundle\Model\Category;
use Mindy\Bundle\VideoBundle\Model\Video;
use Mindy\Bundle\VideoBundle\VideoProvider\Factory;
use Mindy\Bundle\VideoBundle\VideoProvider\VideoParseException;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class VideoForm extends AbstractType
{
    /**
     * @var Factory
     */
    protected $videoFactory;

    /**
     * VideoForm constructor.
     *
     * @param Factory $videoFactory
     */
    public function __construct(Factory $videoFactory)
    {
        $this->videoFactory = $videoFactory;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Название видео',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('source', UrlType::class, [
                'label' => 'Ссылка на видео',
                'constraints' => [
                    new Assert\Url(),
                    new Assert\Callback(function ($value, ExecutionContextInterface $context) {
                        try {
                            $embed = $this->videoFactory->parse($value);
                            if (null === $embed) {
                                $context->addViolation('Unsupported video service.');
                            }
                        } catch (VideoParseException $e) {
                            $context->addViolation('Failed to parse video url. Incorrect url?');
                        }
                    }),
                ],
            ])
            ->add('category', ChoiceType::class, [
                'label' => 'Категория',
                'choices' => Category::objects()->all(),
                'choice_label' => 'name',
                'choice_value' => 'id',
            ])
            ->add('buttons', ButtonsType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
