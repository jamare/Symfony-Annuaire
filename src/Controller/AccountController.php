<?php

namespace App\Controller;


use App\Entity\Customer;
use App\Entity\Provider;
use App\Entity\TempUser;
use App\Form\RegistrationProviderType;
use App\Utils\Mailer;
use App\Form\RegistrationTempType;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
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
        // symfony gère le logout via le security yaml
    }



    /**
     * @Route("/account_temp", name="register_temp")
     */
    public function registerTemp(Request $request, \Swift_Mailer $mailer){

        $tempUser = new TempUser();

        $form = $this->createForm(RegistrationTempType::class, $tempUser);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            // création du token openssl pour s'assurer que le token est unique
            $token = bin2hex(openssl_random_pseudo_bytes(24));

            $tempUser->setToken($token);
            $type = $tempUser->getType();

            $em = $this->getDoctrine()->getManager();
            $em->persist($tempUser);
            $em->flush();

            $message = (new \Swift_Message('Email de confirmation!'))
                ->setFrom('eric.jamar@outlook.be')
                ->setTo($tempUser->getEmail())
                ->setBody(
                        "Merci de confirmer votre inscription, veuillez copier cette URL dans votre navigateur: 127.0.0.1:8000/account/$type/$token", 'text/html' );

            $mailer->send($message);

            $this->addFlash(
                'success',
                "Votre demande de compte a été enregistrée, un email de confirmation vous a été envoyé  !"
            );
        }

        return $this->render('account/register_temp.html.twig',[
            'registrationTemp' => $form->createView()
        ]);
    }


    /**
     * @Route("/account/{type}/{token}", name="account_confirm")
     */
    public function registerConfirm(Request $request, $token, $type, UserPasswordEncoderInterface $encoder)
    {
        $repository = $this->getDoctrine()->getRepository(TempUser::class);
        $repository->findByToken(['token' => $token]);


            if ($type === 'customer') {
                $customer = new Customer();

                $form = $this->createForm(RegistrationType::class, $customer);
                //formulaire gère la requete
                $form->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()){

                    $password = $encoder->encodePassword($customer, $customer->getPassword());
                    $customer->setPassword($password);

                    $customer->setConfirmed(1);
                    $customer->setRegistration(new \DateTime());
                    $customer->setAttempt(0);

                    $em = $this->getDoctrine()->getManager();
                    //$em->remove($tempUser);
                    $em->persist($customer);
                    $em->flush();

                    $this->addFlash(
                        'success',
                        "Votre compte a bien été créé, vous pouvez maintenant vous connecter  !"
                    );
                }

                return $this->render('account/registration.html.twig',[
                    'form' => $form->createView()
                ]);
            }

            else if ($type === 'provider') {
                $provider = new Provider();

                $form = $this->createForm(RegistrationProviderType::class, $provider);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {

                    $password = $encoder->encodePassword($provider, $provider->getPassword());
                    $provider->setPassword($password);

                    $provider->setConfirmed(1);
                    $provider->setRegistration(new \DateTime());
                    $provider->setAttempt(0);

                    $em = $this->getDoctrine()->getManager();
                    //$em->remove($tempUser);
                    $em->persist($provider);
                    $em->flush();

                    $this->addFlash(
                        'success',
                        "Votre compte PRO a bien été créé, vous pouvez maintenant vous connecter  !"
                    );
                }


                return $this->render('account/registration_provider.html.twig',[
                    'form' => $form->createView()
                ]);
            }

    }





}
