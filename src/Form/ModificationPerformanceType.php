<?php
// src/Form/PerformanceType.php
namespace App\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\Epreuve;
use App\Entity\Categorie;
use App\Entity\Typecompetition;
use App\Entity\Echellecompetition;
use App\Entity\Localisationcompetition;
use App\Entity\Resultat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints as Assert;
class ModificationPerformanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('perDatedebut', DateTimeType::class, array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'attr' => ['class' => 'js-datetimepicker'],
            ))
            ->add('perDatefin', DateTimeType::class, array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'attr' => ['class' => 'js-datetimepicker'],
            ))
            ->add('perLieu', TextType::class, array(
                'required' => false,
            ))
            ->add('typeCompetition', EntityType::class, array(
                'class' =>Typecompetition::class,
                'choice_label' => 'typcomNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'mapped' => false,
                'placeholder' => '--choisir--',
            ))
            ->add('echelleCompetition', EntityType::class, array(
                'class' =>Echellecompetition::class,
                'choice_label' => 'echcomNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'mapped' => false,
                'placeholder' => '--choisir--',
            ))
            ->add('localisationCompetition', EntityType::class, array(
                'class' =>Localisationcompetition::class,
                'choice_label' => 'loccomNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'mapped' => false,
                'placeholder' => '--choisir--',
                'required' => false,
            ))
            ->add('epreuve', ChoiceType::class, array(
                'mapped' => false,
                'choices' => $options['filteredEpreuve'],
                'choice_label' => 'eprNom',
                'placeholder' => '--choisir--',
            ))
            ->add('autreEpreuve', TextType::class, array(
                'mapped' => false,
                'required' => false,
            ))
            ->add('categorie', ChoiceType::class, array(
                'label' => 'Catégorie',
                'mapped' => false,
                'choices' => $options['filteredCategorie'],
                'choice_label' => 'catNom',
                'placeholder' => '--choisir--',
            ))
            ->add('autreCategorie', TextType::class, array(
                'mapped' => false,
                'required' => false,
            ))
            ->add('perImportance', ChoiceType::class, array(
                'choices'  => array(
                    'Saison' => true,
                    'Intermédiaire' => false,
                ),
                'multiple' => false,
                'expanded' => true,
                'required' => true,
            ))
            ->add('resultat', EntityType::class, array(
                'class' => Resultat::class,
                'choice_label' => 'resNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'mapped' => false,
                'placeholder' => '--choisir--',
            ))
            ->add('perRessenti', TextType::class, array('label' => 'Ressenti'))
            ->add('image0', FileType::class, array(
                'mapped' => false,
                'required' => false,
            ))
            ->add('image1', FileType::class, array(
                'mapped' => false,
                'required' => false,
            ))
            ->add('image2', FileType::class, array(
                'mapped' => false,
                'required' => false,
            ));

        $builder->get('epreuve')->addEventListener(FormEvents::SUBMIT, [$this, 'requiredEpreuve']);
        $builder->get('categorie')->addEventListener(FormEvents::SUBMIT, [$this, 'requiredCategorie']);
    }

    public function requiredEpreuve(FormEvent $event) {
        $epreuve = $event->getData();
        $form = $event->getForm()->getParent();
        if (empty($epreuve)) {
            return;
        }
        if ($epreuve->getEprNom() == 'Autre') {
            $form
                ->add('autreEpreuve', TextType::class, array(
                    'mapped' => false,
                    'constraints' => new Assert\NotBlank(array('message' => 'Veuillez indiquer votre épreuve')),
                ));
        }
    }
    public function requiredCategorie(FormEvent $event) {
        $categorie = $event->getData();
        $form = $event->getForm()->getParent();
        if (empty($categorie)) {
            return;
        }
        if ($categorie->getCatNom() == 'Autre') {
            $form
                ->add('autreCategorie', TextType::class, array(
                    'mapped' => false,
                    'constraints' => new Assert\NotBlank(array('message' => 'Veuillez indiquer votre catégorie')),
                ));
        }
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Performance',
            'filteredCategorie' => null,
            'filteredEpreuve' => null,
        ));
    }
}