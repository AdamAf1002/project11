<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\Etudiant;
use App\Entity\Resultatbac;
use Symfony\Component\Form\AbstractType;
use App\Validator\Constraints\UniqueEmail;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numetd',NumberType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'8',
                    'maxlength'=>'8',
                    'required' => true,
                    'multiple' => true,
                    'id'=>'inputemail'

                ],
                'label'=>'Numéro étudiant :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4',
                    'for'=>'inputemail'
                ],
                'constraints'=>[
                    new Regex([
                        'pattern' => '/^[0-9]{8}$/',
                        'message' => 'Le champ doit contenir 8 chiffres'
                    ]),
                ]
            ])
            ->add('nom',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'2',
                    'maxlength'=>'50',
                    'required' => true,
                    'id'=>'inputemail'
                    
                ],
                'label'=>'Nom :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4',
                    'for'=>'inputnom'
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
                    'class'=>'form-label mt-4'
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(["min"=>2,"max"=>50,"minMessage"=>"erreur"])

                ]
            ])
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
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Email([
                        'mode' => 'loose',
                        'message' => 'L\'adresse email "{{ value }}" n\'est pas valide.',
                    ]),
                    new UniqueEmail()
                ]
            ])
            ->add('sexe',ChoiceType::class, [
                'label' => 'Genre',
                'choices' => [
                    'Homme' => 'M',
                    'Femme' => 'F',
                    'autre' => 'O',
                ],
                'placeholder' => 'Selectionner le genre',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('adresse',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxlength'=>'60',
                    'required' => true,
                ],
                'label'=>'Adresse :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(["min"=>2,"max"=>50,"minMessage"=>"erreur"])

                ]
            ])
            ->add('tel',TelType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxlength'=>'60',
                    'required' => true,
                ],
                'label'=>'Télephone :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(["min"=>10,"minMessage"=>"erreur"])

                ]
            ])
            ->add('datnaiss',DateType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxlength'=>'60',
                    'required' => true,
                ],
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ],
                'widget' => 'choice',
                'format' => 'dd-MM-yyyy',
                'label'=>'Date de naissance :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
                
            ])
            ->add('depnaiss',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxlength'=>'60',
                    'required' => true,
                ],
                'label'=>'Depatement de naissance :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
                'constraints'=>[
                    new Assert\NotBlank(),

                ]
            ])
            ->add('villnaiss',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxlength'=>'60',
                    'required' => true,
                ],
                'label'=>'Ville de naissance :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(["max"=>60,"minMessage"=>"erreur"])

                ]
            ])
            ->add('paysnaiss',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxlength'=>'60',
                    'required' => true,
                ],
                'label'=>'Pays de naissance :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(["max"=>60,"minMessage"=>"erreur"])

                ]
            ])
            ->add('nationalite',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxlength'=>'60',
                    'required' => true,
                ],
                'label'=>'Nationnalité :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(["max"=>60,"maxMessage"=>"erreur"])

                ]
            ])
            ->add('sports',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxlength'=>'60',
                    'required' => true,
                ],
                'label'=>'Sport :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
                'constraints'=>[
                    new Assert\Length(["max"=>60,"minMessage"=>"erreur"])

                ]
            ])
            ->add('handicape',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxlength'=>'60',
                    'required' => true,
                ],
                'label'=>'Handicape :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
                'constraints'=>[
                    new Assert\Length(["max"=>60,"minMessage"=>"erreur"])
                    

                ]
            ])
            ->add('derdiplome',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxlength'=>'60',
                    'required' => true,
                ],
                'label'=>'Dernier diplome :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
                'constraints'=>[
                    new Assert\Length(["min"=>3, "max"=>60,"minMessage"=>"erreur"]),
                    new Assert\NotBlank()

                ]
            ])
            ->add('dateinsc',DateType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxlength'=>'60',
                    'required' => true,
                ],
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ],
                'widget' => 'choice',
                'format' => 'dd-MM-yyyy',
                'label'=>'Date d\'inscription :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
                
            ])
            ->add('registre',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxlength'=>'60',
                    'required' => true,
                ],
                'label'=>'Registre :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
                'constraints'=>[
                    new Assert\Length(["max"=>60,"minMessage"=>"erreur"])
                    

                ]
            ])
            ->add('statut',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxlength'=>'60',
                    'required' => true,
                ],
                'label'=>'Statut :  ',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
                'constraints'=>[
                    new Assert\Length(["max"=>60,"minMessage"=>"erreur"]),
                    new Assert\NotBlank()

                ]
            ])
            ->add('groupe',EntityType::class,[
                'class' => Groupe::class,
                'label'=>'Groupe :  ',
                'choice_label' => 'nomgrp',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
            ])
            /*->add('ResultatBac',EntityType::class,[
                'class' => Resultatbac::class,
                'choice_label' => 'bac'
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class
        ]);
    }
}
