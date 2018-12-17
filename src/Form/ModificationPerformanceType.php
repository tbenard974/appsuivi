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
                'widget' => 'choice',
            ))
            ->add('perDatefin', DateTimeType::class, array(
                'widget' => 'choice',
            ))
            ->add('perLieu', TextType::class, array('label' => 'Lieu'))
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
            ->add('epreuve', ChoiceType::class, array(
                'label' => 'Epreuve',
                'mapped' => false,
                'choices' => $options['filteredEpreuve'],
                'choice_label' => 'eprNom',
            ))
            ->add('autreEpreuve', TextType::class, array(
                'label' => 'Mon épreuve n\'est pas dans la liste, je l\'ajoute',
                'mapped' => false,
                'required' => false,
            ))
            ->add('categorie', ChoiceType::class, array(
                'label' => 'Catégorie',
                'mapped' => false,
                'choices' => $options['filteredCategorie'],
                'choice_label' => 'catNom',
            ))
            ->add('autreCategorie', TextType::class, array(
                'label' => 'Ma catégorie n\'est pas dans la liste, je l\'ajoute',
                'mapped' => false,
                'required' => false,
            ))
            ->add('perImportance', ChoiceType::class, array(
                'choices'  => array(
                    'Saison' => true,
                    'Intermédiaire' => false,
                ),
                'label' => 'Objectif de la compétition',
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
                'label' => 'Résultat de la compétition',
                'mapped' => false,
            ))
            ->add('perRessenti', TextType::class, array('label' => 'Ressenti'))
			->add('image0', FileType::class, array(
				'mapped' => false,
				'label' => 'Image(JPG)',
                'required' => false,
                //'multiple' => true,
                //'attr' => [
                //    'accept' => 'image/*',
                //    'multiple' => 'multiple'
                //]
            ))
            ->add('image1', FileType::class, array(
				'mapped' => false,
				'label' => 'Image 2 (JPG)',
                'required' => false,
                //'multiple' => true,
                //'attr' => [
                //    'accept' => 'image/*',
                //    'multiple' => 'multiple'
                //]
            ))
            ->add('image2', FileType::class, array(
                'mapped' => false,
                'label' => 'Image 3 (JPG)',
                'required' => false,
                //'multiple' => true,
                //'attr' => [
                //    'accept' => 'image/*',
                //    'multiple' => 'multiple'
                //]
                ));
			
        //$builder->get('epreuve')->addEventListener(FormEvents::SUBMIT, [$this, 'requiredEpreuve']);
        //$builder->get('categorie')->addEventListener(FormEvents::SUBMIT, [$this, 'requiredCategorie']);
    }
    /*public function requiredEpreuve(FormEvent $event) {
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
    }*/

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Performance',
            'filteredCategorie' => null,
            'filteredEpreuve' => null,
        ));
    }

}