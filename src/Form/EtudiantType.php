<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\Etudiant;
use App\Entity\Resultatbac;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints as Assert;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numetd',NumberType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'8',
                    'maxlength'=>'8'
                ],
                'label'=>'Numéro étudiant :',
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(["min"=>8,"max"=>8,"minMessage"=>"erreur"])


                ]
            ])
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('sexe')
            ->add('adresse')
            ->add('tel')
            ->add('datnaiss')
            ->add('depnaiss')
            ->add('villnaiss')
            ->add('paysnaiss')
            ->add('nationalite')
            ->add('sports')
            ->add('handicape')
            ->add('derdiplome')
            ->add('dateinsc')
            ->add('registre')
            ->add('statut')
            ->add('groupe',EntityType::class,[
                'class' => Groupe::class,
                'choice_label' => 'codegrp',
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
