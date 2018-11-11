<?php

namespace App\Controller;

use App\Entity\Services;
use App\Repository\ServicesRepository;
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
        $services=$repo->findAll();
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


}
