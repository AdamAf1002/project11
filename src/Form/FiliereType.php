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
                        'pattern' => '/^Licence informatique\s[1-3]$/',
                        'message' => "la bonne forme est : Licence informatique (1-3)",
                    ]),
                ]
            ])
            ->add('respfiliere',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'5',
                    'maxlength'=>'20'
                ],
                'label'=>'Responsable de la filière :',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Regex([
                        'pattern' => '/^[a-zA-Z]+$/',
                        'message' => "Nom du responsable n'est pas sous la bonne forme",
                    ]),
                ]
            ])
            ->add('codefiliere',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'2',
                    'maxlength'=>'2'
                ],
                'label'=>'Code filière :',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Regex([
                        'pattern' => '/^L[1-3]$/',
                        'message' => "la bonne forme est : L(1-3)",
                    ]),
                ]
            ])
            ->add('element')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Filiere::class,
        ]);
    }
}
