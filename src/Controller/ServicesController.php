<?php

namespace App\Controller;

use App\Entity\Services;
use App\Entity\Provider;
use App\Repository\ServicesRepository;
use App\Repository\ProviderRepository;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(){
        return $this->render('Services/index.html.twig', [
            'controller_name' => 'ServicesController',
        ]);

    }

    /**
     * @Route("/services", name="services")
     */
    public function service_list(ServicesRepository $repo){
        $services=$this->getRepo()->findAll();

        return $this->render('Services/services.html.twig',[
            'controller_name' => 'ServicesController',
            'services' => $services
        ]);
    }

    /**
     * @Route("/service/{id}", name="service_show")
     */
    public function show(Services $services)
    {
        return $this->render('services/show.html.twig', [
            'controller_name' => 'ServicesController',
            'service' => $services
        ]);
    }

    /**
     * @Route("/providers", name="providers")
     */
    public function provider_list(ProviderRepository $repo){
        $providers=$repo->findAll();
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
        /**@var ServicesRepository $sr */
        $sr = $this->getDoctrine()->getRepository(Services::class);
        return $sr;
    }

}
