<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AccountType;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\UpdatePasswordType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    /**
     * Affiche et gère le formulaire de connexion
     * 
     * @Route("/login", name="account_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('account/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * Se déconnecter
     * 
     * @Route("/logout", name="account_logout")
     *
     * @return void
     */
    public function logout(){

    }

    /**
     * Formulaire d'inscription
     * @Route("/register", name="account_register")
     * @return void
     */
    public function register(Request $request, ObjectManager $em, UserPasswordEncoderInterface $encoder){
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                "Votre inscription s'est bien enregistrée !"
            );

            return $this->redirectToRoute('account_login');
        }
        return $this->render('account/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Affiche et gère le profil utilisateur
     * @Route("/account/profile", name="account_profile")
     *
     * @return void
     */
    public function profile(Request $request, ObjectManager $em){
        $user = $this->getUser();
        $form = $this->createForm(AccountType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                "Les données du profils ont été enregistrées avec succes"
            );
        }

        return $this->render('account/profile.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Modification du mot de passe
     * @Route("/account/update-password", name="account_password")
     *
     * @return void
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $em){
        
        $updatePassword = new PasswordUpdate();
        $user = $this->getUser();
        $form = $this->createForm(UpdatePasswordType::class, $updatePassword);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(!password_verify($updatePassword->getOldPassword(), $user->getHash())){
                // Gérer l'erreur
                $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez tapé n'est pas votre mot de passe actuel"));
            } else {
                $newPassword = $updatePassword->getNewPassword();
                $hash = $encoder->encodePassword($user, $newPassword);
                $user->setHash($hash);
                $em->persist($user);
                $em->flush();
                $this->addFlash(
                    'success',
                    "Votre mot de passe à bien été modifié"
                );
                $this->redirectToRoute('whist_index');
            }
            
        }

        return $this->render('account/password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
