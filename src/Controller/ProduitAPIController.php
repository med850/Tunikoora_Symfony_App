<?php

namespace App\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProduitAPIController extends AbstractController
{
    /**
     * @Route("/api/products", name="get_all_customers", methods={"GET"})
     */
    public function getAll(NormalizerInterface $Normalizer)
    {
        $menus = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        $jsonContent = $Normalizer->normalize($menus, 'json', ['groups' => 'post:read']);
        return new Response(json_encode($jsonContent));
    }



    /**
     * @Route("/api/add/product", name="add_product", methods={"POST"})
     */
    public function add(NormalizerInterface $Normalizer,Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);


        $em = $this->getDoctrine()->getManager();
        $Post = new Produit();
        $Post->setNom($request->get('nom'));
        $Post->setPrix($request->get('prix'));
        $Post->setQte($request->get('qte'));
        $Post->setDescription($request->get('description'));
        $Post->setImage($request->get('image'));
       // $Post->setUser($request->get('user_id'));
        $em->persist($Post);
        $em->flush();





        $jsonContent= $Normalizer->normalize($Post,'json',['groups'=>"produit:read"]);
       // return new Response(json_encode($jsonContent));;

        return new JsonResponse(['status' => 'product created!'], Response::HTTP_CREATED);
    }






    /**
     * @Route("api/products/edit/{id}", name="api_edit_products" ,  methods={"POST"})
     */
    public function edit(Request $request)//:JsonResponse
    {

        $id = $request->get("id");
        $nom = $request->query->get("nom");
        $prix = $request->query->get("prix");
        $qte = $request->query->get("qte");
        $description = $request->query->get("description");
        $image = $request->query->get("image");
       // $user = $request->query->get("user_id");

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Produit::class)->find($id);

        //return new JsonResponse(['status' => 'product updated!'], Response::HTTP_CREATED);

    }









    /**
     * @Route("/deleteeEquipeJSON/{id}", name="deleteMenuJSON")
     */
    public function deleteEquipeJSON($id, NormalizerInterface $Normalizer)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository(Produit::class)->find($id);
        $em->remove($menu);
        $em->flush();
        $jsonContent = $Normalizer->normalize($menu, 'json', ['groups' => 'post:read']);
        return new Response("Menu deleted successfully" . json_encode($jsonContent));
    }






}