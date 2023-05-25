<?php

namespace App\Form;

use App\Entity\Bloc;
use App\Entity\Unite;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Regex;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class UniteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('codeunite',TextType::class,[
            'attr'=>[
                'class'=>'form-control',
                'maxlength'=>'20'
            ],
            'label'=>'Code unite :',
            'constraints' => [
                
                new Regex([
                    'pattern' =>  '/^[a-zA-Z0-9\s]+$/',
                    'message' => "veillez ne pas mettre des carac. spéciaux",
                ]),
            ]
        ])
            ->add('nomunite',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'5',
                    'maxlength'=>''
                ],
                'label'=>'Nom unite :',
                'constraints' => [
                    
                    new Regex([
                        'pattern' =>  '/^[a-zA-Z0-9\s]+$/',
                        'message' => "exemple de la forme correcte : 'Algo1' ou 'Algo' ou 'Algo 1'",
                    ]),
                ]
            ])
            ->add('coeficient',NumberType::class,[
                'required'=>false,
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'1',
                    'maxlength'=>'1'
                ],
                'label'=>'Coefficient :',
                'constraints' => [
                    new Assert\Length(['min' => 1, 'max' => 9]),
                    
                ]
            ])
            ->add('respunite', TextType::class, [
                'required'=>false,
                'attr'=>[
                    'class' =>'form-control',
                    'minlength'=>'5',
                    'maxlength'=>''
                ],
                'label'=>'Responsable :',
                'constraints' => [
                   
                ]

            ]
            )
            ->add('bloc', EntityType::class, [
                'class'=>Bloc::class,
                'label'=>'Bloc:',
                'choice_label'=>'nombloc',
                'label_attr'=>["class"=>"form-label-mt-4"
                ]
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Unite::class,
        ]);
    }
}
