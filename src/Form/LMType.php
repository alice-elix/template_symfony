<?php

namespace App\Form;

use App\Entity\LM;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;



class LMType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name_entreprise', null, [
                'label' => 'Nom de l\'entreprise'
            ])
            ->add('first_name_contact', null, [
                'label' => 'Prénom du contact'
            ])
            ->add('last_name_contact', null, [
                'label' => 'Nom du contact'
            ])
            ->add('date_lm', DateType::class, [
                'label'=> 'Date'
            ])
            ->add('lm_object', null, [
                'label'=> 'Objet'
            ])
            ->add('lm_content', TextareaType::class, [
                'label' => 'Corps de la lettre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LM::class,
        ]);
    }
}