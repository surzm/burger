<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\NotBlank;
use AppBundle\Entity\User;
use Sensio\Bundle\GeneratorBundle\Command\Validators;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Validator\Constraints\FormValidator;
use Symfony\Component\Form\Extension\Validator\EventListener\ValidationListener;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Tests\Extension\Validator\ValidatorTypeGuesserTest;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Validation;

class OrderForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('userName', TextareaType::class, array('label' => 'Ваше имя'))
            ->add('phoneNumber', TextareaType::class, array('label' => 'Телефонный номер'))
            ->add('address', TextareaType::class, array('label' => 'Адрес доставки'))
            ->add('submit', SubmitType::class,array(
                'label' => 'Заказать',
                'attr'  => array('class' => 'btn btn-default pull-right')
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Orders'
        ));
    }
}