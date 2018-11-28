<?php
// src/Form/AjoutechelleType.php
namespace App\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Echellecompetition;
use App\Entity\Typecompetition;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AjoutechelleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('echcomNom', TextType::class, array('label' => 'Nom'))
            ->add('echcomDescription', TextType::class, array(
                'label' => 'Description',
                'required' => false))
            ->add('typeCompetition', EntityType::class, array(
                'class' => Typecompetition::class,
                'choice_label' => 'typcomNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'mapped' => false,
                'label' => 'Type',
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\EchelleCompetition'
        ));
    }
}