<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegistrationType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::class, $this->getConfig("Prénom", "Votre prénom"))
            ->add('nom', TextType::class, $this->getConfig("Nom", "Votre nom"))
            ->add('email', EmailType::class, $this->getConfig("E-mail", "Votre adresse mail"))
            ->add('avatar', TextType::class, $this->getConfig("Avatar", "URL de votre avatar", ['required' => false]))
            ->add('hash', PasswordType::class, $this->getConfig("Mot de passe", "Choisissez un bon mot de passe"))
            ->add('passwordConfirm', PasswordType::class, $this->getConfig("Confirmation de mot de passe", "Veuillez confirmer votre mot de passe"))
            ->add('description', TextareaType::class, $this->getConfig("Description", "Présentez-vous !", ['required' => false]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
