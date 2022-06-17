<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', emailType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Adresse email',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Attention, vous avez oubliez dans rentrer un mail']),
                    new Email(['message' => 'Ceci n\'est pas un mail valide']),
                    ]
                ])
            ->add('Sexe', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Vote genre',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'choices' => [
                    'Homme' => 1,
                    'Femme' => 2,
                    'Non défini' => 3
                ],
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('adress', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Votre numéro de rue et votre rue',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 5, 'max' => 255]),
                ]
            ])
            ->add('tel', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Téléphone',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'constraints' => [
                    new NotBlank(),
                    new length(['min' => 10,
                    'minMessage' => 'Vous devez remplir un numéro de téléphone'
                    ])
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'CGV',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
