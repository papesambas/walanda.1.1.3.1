<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Publications;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PublicationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class)
            ->add('contenu', CKEditorType::class)
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image de la Publication',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categories::class
            ])
            ->add('favoris');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Publications::class,
        ]);
    }
}
