<?php

namespace App\Form;

use App\Entity\Creations;
use App\Entity\Technologies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CreationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreCreation')
            ->add('lienCreation')
            ->add('descriptifCreation')
            ->add('technologies', EntityType::class, array(
                'class' => Technologies::class,
                'choice_label' => 'nomTechnologie',
                'multiple' => true,
                'expanded' => true,
                ))
                ->add('imageCreation', FileType::class, [
                    'label' => 'Photo',
                    'mapped' => false,
                    'required' => false,
                    'constraints' => [
                    new File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                    'image/*',
                    ],
                    'mimeTypesMessage' => 'Veuillez entrer un format de document valide',
                    
                    ])
                ],
                    ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Creations::class,
        ]);
    }
}
