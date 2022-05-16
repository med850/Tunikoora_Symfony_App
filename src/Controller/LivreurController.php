<?php

namespace App\Controller;

use App\Entity\Livreur;
use App\Entity\PropertySearch;
use App\Form\LivreurFormType;
use App\Form\PropertySearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreurController extends AbstractController
{
    /**
     * @Route("/livreur", name="app_livreur")
     */
    public function index(): Response
    {
        return $this->render('livreur/index.html.twig', [
            'controller_name' => 'LivreurController',
        ]);
    }

    /**
     * @Route("/addLivreur", name="addLivreur")
     */
    public function addLivreur(Request $request): Response
    {
        $livreur = new Livreur();

        $form = $this->createForm(LivreurFormType::class,$livreur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($livreur);//Add
            $em->flush();

            return $this->redirectToRoute('display_livreur');
        }
        return $this->render('livreur/livreur-form.html.twig',
            ['form'=>$form->createView()]);

    }

    /**
     * @Route("/listLivreur", name="display_livreur")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function displayLivraison( Request $request): Response
    {
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);

        $articles= [];

        if($form->isSubmitted() && $form->isValid()) {

            $nom = $propertySearch->getNom();
            if ($nom != "")

                $articles = $this->getDoctrine()->getRepository(Livreur::class)->findBy(['nom' => $nom]);

        }
        $livreurs = $this->getDoctrine()->getManager()->getRepository(Livreur::class)->findAll();

        return $this->render('livreur/listLivreur.html.twig', ['livreurs'=>$livreurs ,'articles'=> $articles,'form' =>$form->createView(), ]
        ) ;
    }

    /**
     * @Route("/removeLivreur/{id}", name="supp_livreur")
     */
    public function deleteLivraison(Livreur  $livreur): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($livreur);
        $em->flush();

        return $this->redirectToRoute('display_livreur');


    }
    /**
     * @Route("/modifLivreur/{id}", name="modifLivreur")
     */
    public function updateLivreur(Request $request,$id): Response
    {
        $livreur = $this->getDoctrine()->getManager()->getRepository(Livreur::class)->find($id);

        $form = $this->createForm(LivreurFormType::class,$livreur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('display_livreur');
        }
        return $this->render('livreur/livreur-form.html.twig',['form'=>$form->createView()]);




    }
}
