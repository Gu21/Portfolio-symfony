<?php

namespace App\Form;

use App\Entity\Parcours;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class ParcoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreParcours')
            ->add('sousTitreParcours')
            ->add('dateDebutParcours')
            ->add('ordre')
            ->add('dateFinParcours')
            ->add('descriptifParcours', CKEditorType::class)
            ->add('dateDebutParcours',BirthdayType::class)
            ->add('dateFinParcours',BirthdayType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Parcours::class,
           
        ]);
    }
}
