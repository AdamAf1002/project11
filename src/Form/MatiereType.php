<?php
namespace App\Form;

use App\Entity\Matiere;
use App\Entity\Unite;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;


class MatiereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('codemat',TextType::class,[
            'attr'=>[
                'class'=>'form-control',
                'maxlength'=>'20'
            ],
           'constraints' => [
                    
                new Regex([
                    'pattern' =>'/^(?![!@#$%^&*()_+=\[\]{};\':"\\|,.<>\/?`~]+$)(?![0-9]+$).*$/',
                    'message' => "veillez ne pas mettre de carac. spéciaux",
                ]),
            ]
        ])
            
            ->add('nommat',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'5',
                    'maxlength'=>'20'
                ],
                'label'=>'Nom de matiere :',
                'label_attr'=>["class"=>"form-label-mt-4"
            ],
                'constraints' => [
                    
                    new Regex([
                        'pattern' => '/^(?![!@#$%^&*()_+=\[\]{};\':"\\|,.<>\/?`~]+$)(?![0-9]+$).*$/',
                        'message' => "veillez ne pas mettre de carac. spéciaux",
                    ]),
                ]
            ])

            
            ->add('periode', ChoiceType::class, [
                'label'=>'Periode :',
                'label_attr'=>["class"=>"form-label-mt-4"
            ],
                'choices' => [
                'Periode 1' => 'P1',
                'Periode 2' => 'P2',
                'Periode 3' => 'P3',
                'Periode 4' => 'P4',
                'Periode 5' => 'P5',
                'Periode 6' => 'P6',
                'Periode 7' => 'P7',
                'Periode 8' => 'P8',
                'Periode 9' => 'P9',
                'Periode 10' => 'P10',
                'Periode 11' => 'P11',
                'Periode 12' => 'P12',
                'Periode 13' => 'P13',
                'Periode 14' => 'P14',
                'Periode 15' => 'P15',
                ],
            ],[
                'attr'=>[
                    "class"=>"form-control"
                ],

                'constraints' => [
                    new Assert\NotBlank()
                ]
            ])
            ->add('unite', EntityType::class, [
                'class'=>Unite::class,
                'label'=>'Unite:',
                'choice_label'=>'nomunite',
                'label_attr'=>["class"=>"form-label-mt-4"
                ]
            ]);
           
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matiere::class,
        ]);
    }
}
