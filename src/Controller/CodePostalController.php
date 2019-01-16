<?php

namespace App\Controller;

use App\Entity\CodePostal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CodePostalController extends AbstractController
{
    /**
     * Liste des codes postaux
     */
    public function list_code_postal()
    {
        $repository = $this->getDoctrine()->getRepository(CodePostal::class);
        $codePostals = $repository->findAll();
        return $this->render('codepostal/list.html.twig', [
            'codePostals' => $codePostals,
        ]);
    }
}