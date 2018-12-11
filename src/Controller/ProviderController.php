<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Repository\ProviderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProviderController extends AbstractController
{
    /**
     * @Route("/providers", name="providers")
     */
    public function provider_list(ProviderRepository $repo){
        $providers=$repo->findNLast();
        //array_slice pour l'affiche des providers demandés et non la moitié
        $providers = array_slice($providers, 0, 4);
        return $this->render('Services/providers.html.twig',[
            'controller_name' =>'ServicesController',
            'provider' => $providers
        ]);
    }

    /**
     * @Route("/provider/{id}", name="show_provider")
     */
    public function showProvider(Provider $providers)
    {
        return $this->render('services/show_provider.html.twig', [
            'controller_name' => 'ServicesController',
            'provider' => $providers
        ]);
    }

    public function getRepo(){
        /**@var ProviderRepository $pr */
        $pr = $this->getDoctrine()->getRepository(Provider::class);
        return $pr;
    }
}
