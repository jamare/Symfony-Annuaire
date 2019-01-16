<?php

namespace App\Controller;

use App\Entity\Localite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class LocaliteController extends AbstractController
{
    /**
     * Liste des localités
     */
    public function list_localite()
    {
        $repository = $this->getDoctrine()->getRepository(Localite::class);
        $localites = $repository->findAll();
        return $this->render('localite/list.html.twig', [
            'localites' => $localites,
        ]);
    }
}