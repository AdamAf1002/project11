<?php

namespace App\Form;

use App\Entity\User;
use Dompdf\FrameDecorator\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'required' => true,
                ],
                'label'=>'Email :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
                'constraints'=>[
                   new Assert\Email(message:"L'email '{{ value }}' n'est pas valide",mode:"strict")
                   
                   
                ]
            ])
            ->add('nom',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'2',
                    'maxlength'=>'50',
                    'required' => true,
                    
                ],
                'label'=>'Nom :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4',
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(["min"=>2,"max"=>50,"minMessage"=>"erreur"])

                ]
            ])
            ->add('prenom',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'2',
                    'maxlength'=>'50',
                    'required' => true,
                    
                ],
                'label'=>'Prenom :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4',
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(["min"=>2,"max"=>50,"minMessage"=>"erreur"])

                ]
            ])
            ->add('pseudo',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'2',
                    'maxlength'=>'50',
                    'required' => false,
                    
                ],
                'label'=>'Pseudo :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4',
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(["min"=>2,"max"=>50,"minMessage"=>"erreur"])

                ]
            ])
            ->add('sexe',ChoiceType::class, [
                'choices' => [
                    'Homme' => 'M',
                    'Femme' => 'F',
                    'autre' => 'A',
                ],
                'placeholder' => 'Selectionner le genre',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('password',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'4',
                    'maxlength'=>'50',
                    'required' => true,
                    
                ],
                'label'=>'Nom :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4',
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(["min"=>4,"max"=>50,"minMessage"=>"erreur"])

                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
