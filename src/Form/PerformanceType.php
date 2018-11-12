<?php
// src/Form/PerformanceType.php
namespace App\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Epreuve;
use App\Entity\Categorie;
use App\Entity\Typecompetition;
use App\Entity\Echellecompetition;
use App\Entity\Localisationcompetition;
use App\Entity\Resultat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PerformanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeCompetition', EntityType::class, array(
                'class' =>Typecompetition::class,
                'choice_label' => 'typcomNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'label' => 'Type de compétition',
                'mapped' => false,
            ))
            ->add('echelleCompetition', EntityType::class, array(
                'class' =>Echellecompetition::class,
                'choice_label' => 'echcomNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'label' => 'Echelle de compétition',
                'mapped' => false,
            ))
            ->add('localisationCompetition', EntityType::class, array(
                'class' =>Localisationcompetition::class,
                'choice_label' => 'loccomNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'label' => 'Localisation de compétition',
                'mapped' => false,
            ))
            ->add('epreuve', EntityType::class, array(
                'class' =>Epreuve::class,
                'choice_label' => 'eprNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'label' => 'Epreuve',
                'mapped' => false,
            ))
            ->add('categorie', EntityType::class, array(
                'class' =>Categorie::class,
                'choice_label' => 'catNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'label' => 'Categorie',
                'mapped' => false,
            ))
            ->add('importance', ChoiceType::class, array(
                'choices'  => array(
                    'Importante' => true,
                    'Normale' => false,
                ),
                'preferred_choices' => array(false),
                'label' => 'Importance de la compétition',
                'mapped' => false,
            ))
            ->add('perDatedebut', DateType::class, array('widget' => 'choice'))
            ->add('perDatedebut', DateType::class, array('widget' => 'choice'))
            ->add('perDatefin', DateType::class, array('widget' => 'choice'))
            ->add('perLieu', TextType::class, array('label' => 'Lieu'))
            ->add('resultat', EntityType::class, array(
                'class' =>Resultat::class,
                'choice_label' => 'resNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'label' => 'Résultat de la compétition',
                'mapped' => false,
            ))
            ->add('perRessenti', TextType::class, array('label' => 'Ressenti'));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Performance'
        ));
    }
    
}
