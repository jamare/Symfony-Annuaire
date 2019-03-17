<?php

namespace App\Controller;

use App\Entity\Stage;
use App\Entity\Provider;
use App\Form\StageType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class StageController extends AbstractController
{
    /**
     * @Route("/stages", name="stages")
     */
    public function index()
    {
       $repository = $this->getDoctrine()->getRepository(Stage::class);
       $stages = $repository->findAll();

       return $this->render('stage/index.html.twig',[
           "stages" => $stages
       ]);
    }

    /**
     * @Route("stages/add", name="stageAdd")
     */
    public function addStage(Request $request, ObjectManager $manager){
        $stage = new Stage();
        $user = $this->getUser();
        $form= $this->createForm(StageType::class, $stage);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $stage->setProvider($user);
            $em->persist($stage);
            $em->flush();

            $this->addFlash(
                'success',
                'Stage ajouté !'
            );

            return $this->redirectToRoute('stageAdd');
        }
        return $this->render('stage/addStage.html.twig',[
            'form' =>$form->createView(),
            'provider' => $user,
        ]);

    }

    /**
     * @param Stage $stage
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("stages/delete/{id}", name="stageDelete")
     */
    public function deleteStage(Stage $stage){

        $em = $this->getDoctrine()->getManager();
        $em->remove($stage);
        $em->flush();

        $this->addFlash(
            'success',
            'Stage supprimé !'
        );

        return $this->redirectToRoute('stageAdd');

    }
}
