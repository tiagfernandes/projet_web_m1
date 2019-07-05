<?php

namespace App\Form;

use App\Entity\JourCompetition;
use App\Entity\Competition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JourCompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateTimeStart', DateTimeType::class, array(
                'label' => 'Date début'
            ))
            ->add('dateTimeEnd', DateTimeType::class, array(
                'label' => 'Date fin'
            ))
            ->add('competitions', CollectionType::class, array(
                'entry_type' => CompetitionType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JourCompetition::class,
        ]);
    }
}
