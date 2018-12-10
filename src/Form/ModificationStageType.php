<?php
// src/Form/ModificationStageType.php
namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Absence;
use App\Entity\Motifabsence;
use Symfony\Component\Validator\Constraints as Assert;

class ModificationStageType extends AbstractType
{
    private $options = array();

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->options = $options;
        $builder
            ->add('absDatedebut', DateTimeType::class, array(
                'widget' => 'choice',

            ))
            ->add('absDatefin', DateTimeType::class, array(
                'widget' => 'choice',
            ))
            ->add('absLieu', TextType::class, array('label' => 'Lieu'))
            ->add('absFkmotifabsence', EntityType::class, array(
                'class' => Motifabsence::class,
                'choice_label' => 'motabsNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'label' => 'Type d\'évènement',
            ))
            ->add('absRappel',ChoiceType::class, array(
                'choices'  => array(
                    'Aucun' => null,
                    'Au moment de l\'évènement' => '0',
                    '5 minutes avant ' => '5m',
                    '15 minutes avant ' => '15m',
                    '30 minutes avant ' => '30m',
                    '1 heure avant ' => '1h',
                    '2 heures avant ' => '2h',
                    '1 jour avant ' => '1j',
                    '2 jours avant ' => '2j',
                    '1 semaine avant ' => '1s',
                ),
                'label' => 'Souhaitez-vous un rappel ?',
            ))
            ->add('absCommentaire', TextareaType::class, array(
                'label' => 'Notes',
                'required' => false,
            ));
    }
	
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Absence',
            'filteredCategorie' => null,
            'filteredEpreuve' => null,
        ));
    }
}