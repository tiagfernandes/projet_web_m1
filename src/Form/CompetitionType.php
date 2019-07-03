<?php

namespace App\Form;

use App\Entity\Competition;
use App\Entity\TypeCompetition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateTimeStart')
            ->add('dateTimeEnd')
            ->add('typeCompetitions', CollectionType::class, array(
                'entry_type' => TypeCompetitionType::class,
                'allow_add' => true,
                'allow_delete' => true
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Competition::class,
        ]);
    }
}
