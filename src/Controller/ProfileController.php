<?php

namespace App\Controller;

use App\Entity\PasswordUpdate;
use App\Entity\User;
use App\Entity\Customer;
use App\Entity\Provider;
use App\Entity\TempUser;
use App\Form\AccountProType;
use App\Form\AccountType;
use App\Form\PasswordUpdateType;
use App\Form\RegistrationProviderType;
use App\Utils\Mailer;
use App\Form\RegistrationTempType;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface as Generator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ProfileController extends AbstractController
{

    /**
     * Permet d'afficher et de traiter les formulaires de modification de profil : Customer & Provider
     *
     * @Route("/account/profile", name="account_profile")
     *
     * @return Response
     */
    public function profile(Request $request, ObjectManager $manager)
    {
        $user = $this->getUser();
        if($user instanceof Customer){
            $form = $this->createForm(AccountType::class, $user);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    "Les données du profil ont été enregistrées avec succès"
                );
            }

            return $this->render('account/profile.html.twig',[
                'form' => $form->createView()
            ]);
        } elseif ($user instanceof Provider){

            $form = $this->createForm(AccountProType::class, $user);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    "Les données du profil ont été enregistrées avec succès"
                );
            }


            return $this->render('account/profilepro.html.twig',[
                'form' => $form->createView()
            ]);

        }


    }

    /**
     * Permet de modifier le mot de passe
     *
     * @Route("/account/password-update", name="account_password")
     *
     * @return Response
     *
     */
    public function updatePasswordProvider(Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $manager){

        $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Vérifie que le oldPassword soit le même que le password du user
            if(!password_verify($passwordUpdate->getOldPassword(), $user->getPassword())){
                //Gestion de l'erreur :: accès à un enfant du formulaire : oldpassword
                $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez tapé n'est pas votre mot de passes actuel"));
            }else{
                $newPassword = $passwordUpdate->getNewPassword();
                $password = $encoder->encodePassword($user, $newPassword);

                $user->setPassword($password);

                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    "Votre mot de passe a bien été modifié !"
                );

                return $this->redirectToRoute('home');
            }
        }

        return $this->render('account/password.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
