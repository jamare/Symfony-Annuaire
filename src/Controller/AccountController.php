<?php

namespace App\Controller;


use App\Entity\Customer;
use App\Entity\TempUser;
use App\Utils\Mailer;
use App\Form\RegistrationTempType;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectManagerDecorator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface as Generator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;



class AccountController extends AbstractController
{
    /**
     * Permet de gérer le formulaire de connexion
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
            /* Pour confirmation manuel, à supprimer*/
            $customer->setConfirmed(1);
            $customer->setRegistration(new \DateTime());
            $customer->setAttempt(0);
            /********************************/
            $manager->persist($customer);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre compte a bien été créé ! Vous pouvez maintenant vous connecter !"
            );
            return $this->redirectToRoute('account_login');
        }

        return $this->render('account/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/account_temp", name="account_temp")
     */
    public function registerTemp(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){

        $tempUser = new TempUser();

        $form = $this->createForm(RegistrationTempType::class, $tempUser);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            // création du token openssl pour s'assurer que le token est unique
            $token = bin2hex (openssl_random_pseudo_bytes(24));

            $password = $encoder->encodePassword($tempUser, $tempUser->getPassword());

            $tempUser->setToken($token);
            $tempUser->getType();
            $tempUser->setPassword($password);

            $email = new mailer();
            $email->sendConfirmationMail($tempUser);

            $manager->persist($tempUser);
            $manager->flush();

            $this->addFlash(
                'success',
                "Veuillez surveiller votre boite email, un mail de confirmation vient d'y être envoyé ..."
            );
            return $this->redirectToRoute('home');
        }


        return $this->render('account/register_temp.html.twig',[
            'registrationTemp' => $form->createView()
        ]);

    }


    /**
     * @Route("/account_temp/{type}/{token}", name="account_confirm")
     */
    /*public function registerConfirm(Request $request, $token, $type){
        $repository = $this->getDoctrine()->getRepository(TempUser::class);
        $tempUser = $repository->findByOne(['token' => $token]);

        if($tempUser){
            if($type === 'customer'){
                $customer = new Customer();
                $form = $this->createForm(RegistrationType::class, $customer);
                //formulaire gère la requete
                $form->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()){
                    $customer->setConfirmed(1);
                    $customer->setRegistration(new \DateTime());
                    $customer->setAttempt(0);

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($customer);
                    $entityManager->flush();
                }
            }

            else if($type === 'provider'){

            }

            else{
                echo('Erreur : Ce compte est inexistant ou a déjà été créé. ');
                return $this->redirectToRoute('index');
            }

            return $this->render('account/register_temp.html.twig', array(
                'registrationTemp' => $form->createView()
            ));
        }


    }*/
}
