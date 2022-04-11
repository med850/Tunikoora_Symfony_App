<?php

namespace App\Controller;

use App\Entity\Joueur;
use App\Form\JoueurFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JoueurController extends AbstractController
{
    /**
     * @Route("/joueur", name="app_joueur")
     */
    public function index(): Response
    {
        return $this->render('joueur/index.html.twig', [
            'controller_name' => 'JoueurController',
        ]);
    }
    /**
     * @Route("/addJoueur", name="addJoueur")
     */
    public function addJoueur(Request $request): Response
    {
        $joueur = new Joueur();

        $form = $this->createForm(JoueurFormType::class,$joueur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($joueur);//Add
            $em->flush();

            return $this->redirectToRoute('display_joueur');
        }
        return $this->render('admin/ajouterJoueur.html.twig',['form'=>$form->createView()]);

    }
    /**
     * @Route("/display_joueur", name="display_joueur")
     */
    public function displayJoueur(): Response
    {
        $joueurs = $this->getDoctrine()->getManager()->getRepository(Joueur::class)->findAll();
        return $this->render('admin/listJoueur.html.twig', [
            'joueur'=>$joueurs
        ]);
    }

    /**
     * @Route("/removeJoueur/{id}", name="supp_joueur")
     */
    public function deleteJoueur(Joueur  $joueur): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($joueur);
        $em->flush();

        return $this->redirectToRoute('display_joueur');


    }
    /**
     * @Route("/modifJoueur/{id}", name="modifJoueur")
     */
    public function updateJoueur(Request $request,$id): Response
    {
        $joueur = $this->getDoctrine()->getManager()->getRepository(Joueur::class)->find($id);

        $form = $this->createForm(JoueurFormType::class,$joueur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('display_joueur');
        }
        return $this->render('admin/modifierJoueur.html.twig',['form'=>$form->createView()]);




    }
}
