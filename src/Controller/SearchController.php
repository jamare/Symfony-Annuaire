<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Repository\ProviderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function requestPerso(Request $request)
    {
        /** @var ProviderRepository $repository */
        $search_name = $request->get('search_name');
        $search_localite = $request->get('search_localite');
        $search_service = $request->get('search_service');
        $repository = $this->getDoctrine()->getRepository(Provider::class);
        $providers = $repository->searchServiceByNameLocalite($search_name, $search_service, $search_localite);

        return $this->render('search/search_result.html.twig', [
            'providers' => $providers,
        ]);
    }
}
