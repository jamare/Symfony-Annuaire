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



    public function getRepo(){
        /**@var ServicesRepository $sr */
        $sr = $this->getDoctrine()->getRepository(Services::class);
        return $sr;
    }



}
