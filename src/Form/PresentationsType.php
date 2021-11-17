<?php

namespace App\Form;

use App\Entity\Presentations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class PresentationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titrePresentation')
            ->add('sousTitrePresentation')
            ->add('descriptifPresentation')
            ->add('photoPresentation', FileType::class, [
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
                
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Presentations::class,
        ]);
    }
}
