<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('q', EntityType::class, [
                'class'=>Utilisateur::class,
                'choice_label'=>'numero',
                //'multiple'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>"Choix utlisateur"
            ]);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}