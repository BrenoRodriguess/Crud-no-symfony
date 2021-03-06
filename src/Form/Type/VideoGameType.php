<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class VideoGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void

    {
        $builder
            ->add('name', TextType::class, [
                "label" =>"Nome:",
                'attr' => ['minlength' => 8, 'maxlength' => 80],
                "required"=>true
            ])
            ->add('createdAt', DateType::class, [
                "label" =>"data",
                "years"=>["2010", "2015"],
                "required"=>true
            ])
            ->add('updatedAt', DateTimeType::class)
            ->add('APAGAR', ResetType::class)
            ->add('CADASTRAR', SubmitType::class)



        ;
    }
}