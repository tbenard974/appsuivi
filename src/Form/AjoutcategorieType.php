<?php
// src/Form/AjoutcategorieType.php
namespace App\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Categorie;
use App\Entity\Sport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AjoutcategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('catNom', TextType::class, array('label' => 'Nom'))
            ->add('catDescription', TextType::class, array(
                'label' => 'Description',
                'required' => false,))
            ->add('spoId', EntityType::class, array(
                'class' =>Sport::class,
                'choice_label' => 'spoNom',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'label' => 'Sport',
                'mapped' => false,
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Categorie'
        ));
    }
}