<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Section;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, 
            ['label' => 'Titre', 'required' => false, 'empty_data' => ''])

            ->add('description', TextType::class, 
            ['label' => 'Description'])

            ->add('url', TextType::class, 
            ['label' => 'Fichier', 'required' => false,])

            ->add('section', EntityType::class, 
            ['class' =>  Section::class, 'choice_label' => 'title'])
            
            ->add('imageFile', VichFileType::class, 
            ['label' => 'Insérer une image', 'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
