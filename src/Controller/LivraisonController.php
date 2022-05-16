<?php

namespace App\Controller;

use App\Entity\Livraison;
use App\Entity\PropertySearch;
use App\Form\LivraisonFormType;
use App\Form\PropertySearchType;
use App\Repository\LivraisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivraisonController extends AbstractController
{
    /**
     * @Route("/livraison", name="app_livraison")
     */
    public function index(): Response
    {


        return $this->render('livraison/index.html.twig', [
            'controller_name' => 'LivraisonController', ]);
    }

    /**
     * @Route("/addLivraison", name="addLivraison")
     */
    public function addLivraison(Request $request): Response
    {
        $livraison = new Livraison();

        $form = $this->createForm(LivraisonFormType::class,$livraison);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($livraison);//Add
            $em->flush();

            return $this->redirectToRoute('display_livraison');
        }
        return $this->render('livraison/livraison-form.html.twig',
            ['form'=>$form->createView()]);

    }

    /**
     * @Route("/listLivraison", name="display_livraison")
     * @param LivraisonRepository $dateliv
     * @param Request $request
     * @param $ref
     * @return Response
     */
    public function displayLivraison(LivraisonRepository $dateliv, Request $request): Response
    {
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);

        $articles= [];

        if($form->isSubmitted() && $form->isValid()) {

            $nom = $propertySearch->getNom();
            if ($nom != "")

                $articles = $this->getDoctrine()->getRepository(Livraison::class)->findBy(['ref' => $nom]);

        }
        $livreurs = $this->getDoctrine()->getManager()->getRepository(Livraison::class)->findAll();

        return $this->render('livraison/listLivraison.html.twig', ['livreurs'=>$livreurs ,'articles'=> $articles,'form' =>$form->createView(), ]
        ) ;


        
      /*$livraisons = $this->getDoctrine()->getRepository(Livraison::class)->findAll();

        return $this->render('livraison/listLivraison.html.twig', 
          ['livraisons'=>$livraisons,
          ]); */
    }
    /**
     * @Route("/removeLivraison/{id}", name="supp_livraison")
     */
    public function deleteLivraison(Livraison  $livraison): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($livraison);
        $em->flush();

        return $this->redirectToRoute('display_livraison');


    }
    /**
     * @Route("/modifLivraison/{id}", name="modifLivraison")
     */
    public function updateLivraison(Request $request,$id): Response
    {
        $livraison = $this->getDoctrine()->getManager()->getRepository(Livraison::class)->find($id);

        $form = $this->createForm(LivraisonFormType::class,$livraison);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('display_livraison');
        }
        return $this->render('livraison/livraison-form.html.twig',['form'=>$form->createView()]);




    }
    /**
     * @Route("/modifEtat/{id}", name="modifEtat    ")
     */
    public function updateEtat(Request $request,$id): Response
    {
        $livraison = $this->getDoctrine()->getManager()->getRepository(Livraison::class)->find($id);


        $form = $this->createForm(LivraisonFormType::class,$livraison);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('display_livraison');
        }
        return $this->render('livraison/livraison-form.html.twig',['form'=>$form->createView()]);




    }
}
