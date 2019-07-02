<?php

namespace App\Form;

use App\Entity\Entrainement;
use App\Entity\Groupe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrainementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateTimeStart', DateTimeType::class)
            ->add('dateTimeEnd', DateTimeType::class)
            ->add('groupes', EntityType::class, array(
                'class' => Groupe::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entrainement::class,
        ]);
    }
}
