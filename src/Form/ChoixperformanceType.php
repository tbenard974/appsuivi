<?php
// src/Form/ChoixperformanceType.php
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
use App\Entity\Absence;
use App\Entity\Categorie;
use App\Entity\Typecompetition;
use App\Entity\Echellecompetition;
use App\Entity\Localisationcompetition;
use App\Entity\Resultat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ChoixperformanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', ChoiceType::class, array (
				'label' => 'A partir de',
                'choices' => $options['allAbsence'],
				'mapped' => false,
				'choice_label' => 'absNom',
            ));
        
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Absence',
            'allAbsence' => null,
        ));
    }
}