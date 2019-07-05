<?php


namespace App\Form;


use App\Entity\MaitreArmes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScoreCompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('')
            ->add('firstName')
            ->add('lastName')
            ->add('dtBirthday', DateType::class)
            ->add('email')
            ->add('phone')
            ->add('createdAt', DateType::class)
            ->add('username')
            ->add('rawPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => false,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'PasswordBis'],
            ])
            ->add('handisport')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MaitreArmes::class,
        ]);
    }
}