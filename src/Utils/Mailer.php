<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 24-01-19
 * Time: 18:48
 */


namespace App\Utils;

use App\Entity\TempUser;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface as Generator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class Mailer {

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Generator
     */
    private $urlGenerator;

    public function __construct(\Swift_Mailer $mailer, Generator $urlGenerator) {
        $this->mailer = $mailer;
        $this->urlGenerator = $urlGenerator;
    }

    public function sendConfirmationMail(TempUser $user){
        $message = new \Swift_Message('Confirmation');
        $message->setFrom('info@bienetre.com')
            ->setTo($user->getEmail())
            ->setBody(
                sprintf('Veuillez confirmer votre inscription : <a href="%s">Token</a>',
                    $this->urlGenerator->generate(
                        'confirm_inscription', ['token'=>$user->getToken()], UrlGeneratorInterface::ABSOLUTE_URL
                    )
                ), 'text/html'
            );
        $this->mailer->send($message);
    }
}
