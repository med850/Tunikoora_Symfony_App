<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipeController extends AbstractController
{
    /**
     * @Route("/equipe", name="ajouter_equipe")
     */
    public function index(): Response
    {
        return $this->render('admin/ajouterEquipe.html.twig', [
            'controller_name' => 'EquipeController',
        ]);
    }
     /**
     * @Route("/addEquipe", name="addEquipe")
     */
    public function addEquipe(Request $request): Response
    {
        $equipe = new Equipe();

        $form = $this->createForm(EquipeFormType::class,$equipe);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipe);//Add
            $em->flush();

            return $this->redirectToRoute('display_equipe');
        }
        return $this->render('admin/ajouterEquipe.html.twig',['form'=>$form->createView()]);

    }
    /**
     * @Route("/listEquipe", name="display_equipe")
     */
    public function displayEquipe(): Response
    {
        $equipes = $this->getDoctrine()->getManager()->getRepository(Equipe::class)->findAll();
        return $this->render('admin/listEquipe.html.twig', [
            'equipe'=>$equipes
        ]);
    }

    /**
     * @Route("/removeEquipe/{id}", name="supp_equipe")
     */
    public function deleteEquipe(Equipe  $equipe): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($equipe);
        $em->flush();

        return $this->redirectToRoute('display_equipe');


    }
    /**
     * @Route("/modifEquipe/{id}", name="modifEquipe")
     */
    public function updateEquipe(Request $request,$id): Response
    {
        $equipe = $this->getDoctrine()->getManager()->getRepository(Equipe::class)->find($id);

        $form = $this->createForm(EquipeFormType::class,$equipe);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('display_equipe');
        }
        return $this->render('admin/modifierEquipe.html.twig',['form'=>$form->createView()]);




    }
}

