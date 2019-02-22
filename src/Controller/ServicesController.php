<?php

namespace App\Controller;

use App\Entity\Services;
use App\Entity\Provider;
use App\Repository\ServicesRepository;
use App\Repository\ProviderRepository;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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

    /**
     * Permet de créer une annonce
     *
     * @Route("services/new", name="ads_create")
     * @IsGranted("ROLE_USER")
     *
     * @return Response
     *
     */
    public function create(){
        return $this->render('services/new.html.twig');
    }


    public function getRepo(){
        /**@var ServicesRepository $sr */
        $sr = $this->getDoctrine()->getRepository(Services::class);
        return $sr;
    }

    public function list_services_search(){
        $repository = $this->getDoctrine()->getRepository(Services::class);
        $services = $repository->findAll();

        return $this->render('services/list_services_search.html.twig',[
            'services' => $services,
        ]);

    }

}
