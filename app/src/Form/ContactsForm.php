<?php

namespace App\Form;

use App\Entity\Contacts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Veuillez entrer votre email',
                    'class' => 'fs-4',
                ]
            ])
            ->add('subject', TextType::class, [
                'attr' => [
                    'placeholder' => 'Veuillez entrer le sujet',
                    'class' => 'fs-4',
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Veuillez entrer votre message',
                    'class' => 'fs-4',
                    'cols' => 10,
                    'rows' => 10,
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'J\'acceptes les conditions d\'utilisations',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'attr' => [
                    'class' => 'fs-5',
                ]
            ])
            ->add('envoyer', SubmitType::class, [
                'attr' => [
                    'disabled' => true,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contacts::class,
        ]);
    }
}
