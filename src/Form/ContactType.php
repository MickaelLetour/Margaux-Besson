<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)//construit le formulaire de création de contact avec les données de l entité
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom *'
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom *'
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'label' => 'Téléphone' 
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email *' 
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message *' 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }

}
