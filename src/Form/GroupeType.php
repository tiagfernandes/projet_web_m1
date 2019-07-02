<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\Tireur;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class GroupeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('tireurs',EntityType::class,array(
                "class" => Tireur::class,
                "choice_label"=>"firstName",
                "multiple"=>TRUE,
                "required" => false,
                "query_builder"=>function(EntityRepository $er)
                {
                    return $er->createQueryBuilder('t')->where('t.groupe is null');
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Groupe::class,
        ]);
    }
}
