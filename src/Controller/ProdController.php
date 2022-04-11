<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\Produit1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prod")
 */
class ProdController extends AbstractController
{
    /**
     * @Route("/", name="app_prod_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager
            ->getRepository(Produit::class)
            ->findAll();

        return $this->render('prod/index.html.twig', [
            'produits' => $produits,
        ]);
    }

    /**
     * @Route("/new", name="app_prod_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(Produit1Type::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            // On boucle sur les images
            foreach($image as $ima){
                $fichier = md5(uniqid()) . '.' . $ima->guessExtension();

                $ima->move(
                    $this->getParameter('img_directory'),
                    $fichier
                );
            }
            $entityManager = $this->getDoctrine()->getManager();
            $produit->setImage($fichier);
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('app_prod_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prod/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_prod_show", methods={"GET"})
     */
    public function show(Produit $produit): Response
    {
        return $this->render('prod/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_prod_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Produit1Type::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_prod_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prod/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_prod_delete", methods={"POST"})
     */
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_prod_index', [], Response::HTTP_SEE_OTHER);
    }
}
