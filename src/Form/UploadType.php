<?php

namespace App\Form;

use App\Entity\Tbltranscriptionupload;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('itmTitreLg1', TextType::class)
            // ->add('itmTxtClientLg1', TextareaType::class)
            // ->add('itmDate', DateType::class)
            // //->add('itmType',TextType::class)
            // ->add('itmTaille', TextType::class)
            // ->add('itmDuree', TextType::class)
            // ->add('itmATranscrire')
            // ->add('itmFichier')
            // ->add('itmDeadlineRequise', DateType::class)
            ->add('file', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => true
            ])
            ->add('valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tbltranscriptionupload::class,
        ]);
    }
}
