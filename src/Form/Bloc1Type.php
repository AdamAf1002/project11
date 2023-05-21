<?php

namespace App\Form;

use App\Entity\Bloc;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
class Bloc1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
                        'pattern' => '/^[a-zA-Z ]+$/',
                        'message' => "Nom de bloc n'est pas sous la bonne forme",
                    ]),
                ]

            ]
            )
            ->add('noteplancher', NumberType::class, [
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'1',
                    'maxlength'=>'1',
                ],
                'label'=>'Note Plancher :',
                'constraints' => [
                    new Assert\Length(['min' => 0, 'max' => 9]),
                    new Assert\NotBlank(),
                ]
            ])
            ->add('filiere')
            ->add('element')
            
        ;
    }   

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bloc::class,
        ]);
    }
}
