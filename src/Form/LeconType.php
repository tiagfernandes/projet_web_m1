<?php

namespace App\Form;

use App\Entity\Entrainement;
use App\Entity\Lecon;
use App\Entity\MaitreArmes;
use App\Entity\Tireur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LeconType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tireur', EntityType::class, array(
                'class' => Tireur::class,
                'choice_label' => 'firstName'
            ))
            ->add('maitreArmes', EntityType::class, array(
                'class' => MaitreArmes::class,
                'choice_label' => 'firstName'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lecon::class,
        ]);
    }
}
