<?php

namespace App\Controller;


use App\Entity\Customer;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectManagerDecorator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class AccountController extends AbstractController
{
    /**
     * Permet de gérer le forumaire de connexion
     *
     * @Route("/login", name="account_login")
     *
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();

        $username = $utils->getLastUsername();

        return $this->render('account/login.html.twig',[
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * Permet de se déconnecter
     *
     * @Route("/logout", name="account_logout")
     *
     * @return void
     */
    public function logout(){
        // symfony gère le logout
    }

    /**
     * Permet d'afficher le formulaire d'inscription
     *
     * @Route("/register", name="account_register")
     *
     * @return Response
     */
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
        $customer = new Customer();

        $form = $this->createForm(RegistrationType::class, $customer);
        //formulaire gère la requete
        $form->handleRequest($request);

        // si le formulaire est soumis et validé, le manager va persister l'utilisateur, et envoyer la requête
        if($form->isSubmitted() && $form->isValid()){
            $password = $encoder->encodePassword($customer, $customer->getPassword());
            $customer->setPassword($password);

            $manager->persist($customer);
            $manager->flush();
        }

        return $this->render('account/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
