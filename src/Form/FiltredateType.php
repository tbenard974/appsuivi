<?php
// src/Form/FiltredateType.php
namespace App\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\Echellecompetition;
use App\Entity\Typecompetition;
use App\Entity\Sport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FiltredateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder      
            ->add('Datedebut', DateType::class, array(
                'widget' => 'choice',
                'label' => 'Date de début',
                'data' => new \DateTime("now"),
                'years' => range(date('Y'), date('Y')+5),
                'mapped' => false,
            ))
            ->add('Datefin', DateType::class, array(
                'widget' => 'choice',
                'label' => 'Date de fin',
                'data' => new \DateTime("now"),
                'years' => range(date('Y'), date('Y')+5),
                'mapped' => false,
            ));
    }        
}
    