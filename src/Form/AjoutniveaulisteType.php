<?php
// src/Form/AjoutniveaulisteType.php
namespace App\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Niveaulisteministerielle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AjoutniveaulisteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nivlisminNom', TextType::class, array('label' => 'Nom'))
            ->add('nivlisminDescription', TextType::class, array(
                'label' => 'Description',
                'required' => false));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Niveaulisteministerielle'
        ));
    }
}