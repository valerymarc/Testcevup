<?php

namespace App\Form;

use App\Entity\Achat;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AchatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('produit1', IntegerType::class, [
                'attr' => [
                    'class'=>'form-control',
                    'placeholder'=>'Produit 1'
                ]
            ])
            ->add('produit2', IntegerType::class, [
                'attr' => [
                    'class'=>'form-control',
                    'placeholder'=>'Produit 2'
                ]
            ])
            ->add('produit3', IntegerType::class, [
                'attr' => [
                    'class'=>'form-control',
                    'placeholder'=>'Produit 3'
                ]
            ])
            ->add('produit4', IntegerType::class, [
                'attr' => [
                    'class'=>'form-control',
                    'placeholder'=>'Produit 4'
                ]
            ])
            ->add('createdAt', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class'=>'form-control'
                ]
            ])
            ->add('utilisateur', EntityType::class, [
                'class'=>Utilisateur::class,
                'choice_label'=>'numero',
                //'multiple'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Achat::class,
        ]);
    }
}
