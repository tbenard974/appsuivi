<?php
// src/Form/EvenementType.php
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
use App\Entity\Typecompetition;
use App\Entity\Echellecompetition;
use App\Entity\Localisationcompetition;
use App\Entity\Epreuve;
use App\Entity\Categorie;
use Symfony\Component\Validator\Constraints as Assert;
class EvenementType extends AbstractType
{
    private $options = array();

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->options = $options;
        $builder
            ->add('absDatedebut', DateTimeType::class, array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy hh:mm',
                'html5' => false,
                'attr' => ['class' => 'js-datetimepicker'],
            ))
            ->add('absDatefin', DateTimeType::class, array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy hh:mm',
                'html5' => false,
                'attr' => ['class' => 'js-datetimepicker'],
            ))
            ->add('absLieu', TextType::class, array(
                'required' => false
            ))
            ->add('absFkmotifabsence', EntityType::class, array(
                'class' => Motifabsence::class,
                'choice_label' => 'motabsNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
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
            ))
            ->add('absCommentaire', TextareaType::class, array(
                'required' => false,
            ));
		
        $builder->get('absFkmotifabsence')->addEventListener(FormEvents::SUBMIT, [$this, 'addEvenement']);
    }

    public function addEvenement(FormEvent $event) {
        $absence = $event->getData();
        $form = $event->getForm()->getParent();
        if (empty($absence)) {
            return;
        }
        if ($absence->getMotabsNom() == 'Compétition') {
            $form
                ->add('typeCompetition', EntityType::class, array(
                    'class' =>Typecompetition::class,
                    'choice_label' => 'typcomNom',
                    // used to render a select box, check boxes or radios
                    'multiple' => false,
                    'expanded' => false,
                    'label' => 'Type de la compétition',
                    'mapped' => false,
                    'constraints' => new Assert\NotBlank(array('message' => 'Veuillez remplir les champs liés à votre compétition')),
                    'placeholder' => '--choisir--',
                ))
                ->add('echelleCompetition', EntityType::class, array(
                    'class' =>Echellecompetition::class,
                    'choice_label' => 'echcomNom',
                    // used to render a select box, check boxes or radios
                    'multiple' => false,
                    'expanded' => false,
                    'label' => 'Échelle de la compétition',
                    'mapped' => false,
                    'placeholder' => '--choisir--',
                ))
                ->add('localisationCompetition', EntityType::class, array(
                    'class' =>Localisationcompetition::class,
                    'choice_label' => 'loccomNom',
                    // used to render a select box, check boxes or radios
                    'multiple' => false,
                    'expanded' => false,
                    'label' => 'Localisation de la compétition',
                    'mapped' => false,
                    'placeholder' => '--choisir--',
                ))
            ;
        }

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