<?php


namespace App\Form;


use App\Entity\Blason;
use App\Entity\CategorieAge;
use App\Entity\Competition;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('blason', EntityType::class, array(
                'class' => Blason::class,
                'choice_label' => 'grade',
                'placeholder' => 'Aucun'
            ))
            ->add('arme')
            ->add('civ')
            ->add('categorie', EntityType::class, array(
                'class' => CategorieAge::class,
                'choice_label' => 'name'
            ))
            ->add('handisport');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Competition::class,
        ]);
    }

}