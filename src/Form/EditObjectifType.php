<?php


namespace App\Form;

use App\Entity\Objectif;
use App\Entity\Tireur;
use Doctrine\ORM\EntityRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter\AlignFormatter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditObjectifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commentaires', CollectionType::class, array(
                'entry_type' => CommentaireType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => ' ',

            ));

    }

    public function getParent()
    {
        return ObjectifType::class;
    }

}
