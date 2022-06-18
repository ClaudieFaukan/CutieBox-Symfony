<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('UserName', TextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Nom']
            ])
            ->add('UserPassword', PasswordType::class, [
                'label' => 'Mot de Passe',
                'attr' => ['placeholder' => 'Mot de Passe']
            ])
            ->add('UserMail', EmailType::class, [
                "label" => "Adresse mail",
                "attr" => ["placeholder" => "Adresse mail"]
            ])
            ->add('date_debut', DateType::class)
            ->add('date_fin', DateType::class)

            ->add('autorisation_partage_gallerie')

            ->add('templates_photo_id');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
