<?php

namespace App\Form;

use App\Entity\Entrainement;
use App\Entity\Groupe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrainementYearType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entrainements', CollectionType::class, array(
                'label' => ' ',
                'entry_type' => EntrainementType::class,
                'allow_add' => true,
                'allow_delete' => true

            ))
        ;
    }
}
