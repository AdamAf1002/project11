<?php

namespace App\Form;

use App\Entity\Filiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Regex;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Webmozart\Assert\Assert as AssertAssert;

class FiliereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomfiliere',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'5',
                    'maxlength'=>'30'
                ],
                'label'=>'Nom filière :',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Regex([
                        'pattern' => '/^(?![!@#$%^&*()_+=\[\]{};\':"\\|,.<>\/?`~]+$)(?![0-9]+$).*$/',
                        'message' => "veillez ne pas mettre des caractéres spéciaux",
                    ]),
                ]
            ])
            ->add('respfiliere',TextType::class,[
                "required"=>false,
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'5',
                    'maxlength'=>'20'
                ],
                'label'=>'Responsable de la filière :',
                'constraints' => [
                   
                    new Regex([
                        'pattern' =>  '/^[a-zA-Z0-9\s]+$/',
                        'message' => "Veillez saisir le nom du responsable de la filière",
                    ]),
                ]
            ])
            ->add('codefiliere',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                ],
                    
                    'label'=>'Code filière :',
               
                
                
            ]);
           

        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Filiere::class,
        ]);
    }
}
