<?php

namespace App\Form\Type;

use App\Entity\VideoGame;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class JogoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void

    {
        $builder
            ->add('nome', TextType::class, [
                "label" =>"Nome:",
                'attr' => ['minlength' => 8, 'maxlength' => 80],
                "required"=>true
            ])
            ->add('videogame', EntityType::class,[
                'class' => VideoGame::class,
                'choice_label' => 'name',
            ])
            ->add('APAGAR', ResetType::class)
            ->add('CADASTRAR', SubmitType::class)



        ;
    }
}