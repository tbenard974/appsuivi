<?php
// src/Form/ProfildepartementType.php
namespace App\Form;
use App\Entity\Departement;
use App\Entity\Sport;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Utilisateur;


class ProfildepartementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('utiDepartement', EntityType::class, array(
                'class' =>Departement::class,
                'choice_label' => 'depNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'label' => 'Departement',
                'mapped' => false,
            ));
    }     
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Utilisateur'
        ));
    }
}