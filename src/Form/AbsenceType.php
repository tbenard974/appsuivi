<?php 
// src/Form/AbsenceType.php
namespace App\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Absence;
use App\Entity\Motifabsence;
use Symfony\Component\Validator\Constraints as Assert;

class AbsenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('absFkmotifabsence', EntityType::class, array(
                'class' => Motifabsence::class,
                'choice_label' => 'motabsNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
            ))
            ->add('absDatedebut', DateType::class, array('widget' => 'choice'))
            ->add('absDatefin', DateType::class, array('widget' => 'choice'))
            ->add('absLieu', TextType::class, array('label' => 'Lieu'))
            ->add('absCommentaire', TextType::class, array('label' => 'Évènement'))
            ;
        
        $builder->get('absFkmotifabsence')->addEventListener(FormEvents::SUBMIT, [$this, 'addFiles']);
    }
    
    public function addFiles(FormEvent $event) {
        $absence = $event->getData();
        $form = $event->getForm()->getParent();

        if (empty($absence)) {
            return;
        }
        if ($absence->getMotabsNom() == 'Compétition') {
            $form
                ->add('fichier', FileType::class, array(
                    'mapped' => false,
                    'label' => 'Fichier (.pdf)',
                    'constraints' => new Assert\NotBlank(array('message' => 'Veuillez joindre votre convocation')),
                ));
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Absence'
        ));
    }
}