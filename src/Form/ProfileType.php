<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civ')
            ->add('firstName')
            ->add('lastName')
            ->add('dtBirthday', DateType::class)
            ->add('email')
            ->add('phone')
            ->add('username')
            ->add('rawPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => false,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'PasswordBis'],
            ]);
    }
}