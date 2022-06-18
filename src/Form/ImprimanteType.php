<?php

namespace App\Form;

use App\Entity\Imprimante;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ImprimanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ImpriName', TextType::class, [
                'label' => "Nom de l'imprimante",
                'attr' => [
                    "placeholder" => "Nom de l'imprimante"
                ]
            ])
            ->add('ImpriSerialNumber', TextType::class, [
                'label' => "Numéro de série",
                'attr' => [
                    "placeholder" => "Numéro de série"
                ]
            ])
            ->add('ID_PrintNode', IntegerType::class, [
                'label' => "ID sur API",
                'attr' => [
                    "placeholder" => "ID sur API PrintNode"
                ]
            ])
            ->add('ImpriStatus', TextType::class, [
                'label' => "Statut",
                'attr' => [
                    "placeholder" => "Statut de l'imprimante"
                ]
            ])
            ->add('DateDebut', DateTimeType::class, [
                'label' => "Date début"
            ])
            ->add('DateFin', DateTimeType::class, [
                'label' => "Date fin"
            ])
            ->add('ImpriStatus', TextType::class, [
                'label' => "Statut",
                'attr' => [
                    "placeholder" => "LIBRE ou OCCUPE uniquement"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Imprimante::class,
        ]);
    }
}
