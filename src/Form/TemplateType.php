<?php

namespace App\Form;

use App\Entity\TemplatesPhoto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TemplateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Portrait1p', TextType::class, [
                'label' => "Portrait 1 perosnne(cutie)",
                'attr' => [
                    "placeholder" => "templateCutie/dossier/image.png"
                ]
            ])
            ->add('Portrait4p', TextType::class, [
                'label' => "Portrait 4 personnes",
                'attr' => [
                    "placeholder" => "templateCutie/dossier/image.png"
                ]
            ])
            ->add('Centrer1p', TextType::class, [
                'label' => "Centrer 1 personne",
                'attr' => [
                    "placeholder" => "templateCutie/dossier/image.png"
                ]
            ])
            ->add('Centrer4p', TextType::class, [
                'label' => "Centrer 4 personnes",
                'attr' => [
                    "placeholder" => "templateCutie/dossier/image.png"
                ]
            ])
            ->add('Paysage1p', TextType::class, [
                'label' => "Paysage 1 personne (cutie)",
                'attr' => [
                    "placeholder" => "templateCutie/dossier/image.png"
                ]
            ])
            ->add('Paysage4p', TextType::class, [
                'label' => "Paysage 4 personnes",
                'attr' => [
                    "placeholder" => "templateCutie/dossier/image.png"
                ]
            ])
            ->add('Strip', TextType::class, [
                'label' => "Strip",
                'attr' => [
                    "placeholder" => "templateCutie/dossier/image.png"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TemplatesPhoto::class,
        ]);
    }
}
