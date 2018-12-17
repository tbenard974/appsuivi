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
            ->add('absDatedebut', DateTimeType::class, [
                'widget' => 'single_text',

                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'datetimepicker1'],


            ])
            ->add('absDatefin', DateTimeType::class, array(
                'widget' => 'choice',
                'data' => new \DateTime("now"),
                'years' => range(date('Y'), date('Y')+5),
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
                    'label' => 'Type de compétition',
                    'mapped' => false,
                    'constraints' => new Assert\NotBlank(array('message' => 'Veuillez remplir les champs liés à votre compétition')),
                ))
                ->add('echelleCompetition', EntityType::class, array(
                    'class' =>Echellecompetition::class,
                    'choice_label' => 'echcomNom',
                    // used to render a select box, check boxes or radios
                    'multiple' => false,
                    'expanded' => false,
                    'label' => 'Echelle de la compétition',
                    'mapped' => false,
                ))
                ->add('localisationCompetition', EntityType::class, array(
                    'class' =>Localisationcompetition::class,
                    'choice_label' => 'loccomNom',
                    // used to render a select box, check boxes or radios
                    'multiple' => false,
                    'expanded' => false,
                    'label' => 'Localisation de la compétition',
                    'mapped' => false,
                ))
                /* ->add('epreuve', EntityType::class, array(
                    'class' =>Epreuve::class,

					'choice_label' => 'eprNom',
                    // used to render a select box, check boxes or radios
                    'multiple' => false,
                    'expanded' => false,
                    'label' => 'Epreuve',
                    'mapped' => false,
                )) 
                ->add('epreuve', ChoiceType::class, array(
                    'label' => 'Epreuve',
                    'mapped' => false,
                    'choices' => $this->options['filteredEpreuve'],
                    'choice_label' => 'eprNom',
                ))
                ->add('autreEpreuve', TextType::class, array(
                    'label' => 'Mon épreuve n\'est pas dans la liste, je l\'ajoute',
                    'mapped' => false,
                    'required' => false,
                ))
                /* ->add('categorie', EntityType::class, array(
                    'class' =>Categorie::class,
                    'choice_label' => 'catNom',
                    // used to render a select box, check boxes or radios
                    'multiple' => false,
                    'expanded' => false,
                    'label' => 'Categorie',
                    'mapped' => false,
                ))
                ->add('categorie', ChoiceType::class, array(
                    'label' => 'Categorie',
                    'mapped' => false,
                    'choices' => $this->options['filteredCategorie'],
                    'choice_label' => 'catNom',
                ))
                ->add('autreCategorie', TextType::class, array(
                    'label' => 'Ma catégorie n\'est pas dans la liste, je l\'ajoute',
                    'mapped' => false,
                    'required' => false,
                ))
                ->add('importance', ChoiceType::class, array(
                    'choices'  => array(
                        'Saison' => true,
                        'Intermédiaire' => false,
                    ),
                    'preferred_choices' => array(false),
                    'label' => 'Objectif de la compétition',
                    'multiple' => false,
                    'expanded' => true,
                    'required' => true,
                    'mapped' => false,
                ))*/
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