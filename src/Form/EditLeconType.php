<?php

namespace App\Form;

use App\Entity\Entrainement;
use App\Entity\Lecon;
use App\Entity\MaitreArmes;
use App\Entity\Tireur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditLeconType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commentaires', CollectionType::class, array(
                'entry_type' => CommentaireType::class,
                'allow_add' => true,
                'allow_delete' => true,

            ))
        ;
    }

    public function getParent()
    {
        return LeconType::class;
    }
}
