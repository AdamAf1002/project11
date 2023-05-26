<?php

namespace App\Form;

use App\Entity\Bloc;
use App\Entity\Filiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class Bloc1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        ->add('codebloc', TextType::class, [
            'attr'=>[
                'class' =>'form-control',
                'maxlength'=>''
            ],
            'label'=>'Code Bloc :',
            'constraints' => [
                new Assert\Length(['min' => 2, 'max' => 50]),
                new Assert\NotBlank(),
                new Regex([
                    'pattern' => '/^[a-zA-Z0-9\s]+$/',
                    'message' => "Mauvaise forme",
                ]),
            ]

        ]
        )
            ->add('nombloc', TextType::class, [
                'attr'=>[
                    'class' =>'form-control',
                    'minlength'=>'5',
                    'maxlength'=>''
                ],
                'label'=>'Nom Bloc :',
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank(),
                    new Regex([
                        'pattern' =>  '/^[a-zA-Z0-9\s]+$/',
                        'message' => "Mauvaise forme",
                    ]),
                ]

            ]
            )
            ->add('noteplancher', NumberType::class, [
                'required'=>false,
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'1',
                    'maxlength'=>'1',
                ],
                'label'=>'Note Plancher :',
                'constraints' => [
                    new Assert\Length(['min' => 0, 'max' => 9]),
                    
                ]
            ])
            ->add('filiere',EntityType::class, [
                'class' =>Filiere::class,
                'choice_label' => 'nomfiliere', 
                'placeholder' => 'Sélectionnez une filière',
            ])
        
            
        ;
    }   

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bloc::class,
        ]);
    }
}
