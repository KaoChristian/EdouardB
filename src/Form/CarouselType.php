<?php

namespace App\Form;

use App\Entity\Carousel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarouselType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url', TextType::class, ['label' => 'Fichier'])

            ->add('altName', TextType::class, 
            ['label' => 'Nom alternatif', 'required' => false, 'empty_data' => ''])

            ->add('title', TextType::class, 
            ['label' => 'Titre', 'required' => false, 'empty_data' => ''])

            ->add('description', TextType::class, 
            ['label' => 'Description', 'required' => false, 'empty_data' => ''])

            ->add('button', TextType::class, 
            ['label' => 'Bouton', 'required' => false, 'empty_data' => ''])

            ->add('link', TextType::class, 
            ['label' => 'Lien', 'required' => false, 'empty_data' => ''])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Carousel::class,
        ]);
    }
}
