<?php

namespace App\Controller;

use App\Entity\Equipe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\EquipeRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class EquipeAPIController extends AbstractController
{
    /**
     * @Route("/showEquipeJSON", name="showEquipeJSON")
     */
    public function showEquipeJSON(NormalizerInterface $Normalizer)
    {
        $menus = $this->getDoctrine()->getRepository(Equipe::class)->findAll();
        $jsonContent = $Normalizer->normalize($menus, 'json', ['groups' => 'post:read']);
        return new Response(json_encode($jsonContent));
    }
    /** 
     * @Route("/deleteEquipeJSON/{id}", name="deleteMenuJSON")
     */
    public function deleteEquipeJSON($id, NormalizerInterface $Normalizer)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository(Equipe::class)->find($id);
        $em->remove($menu);
        $em->flush();
        $jsonContent = $Normalizer->normalize($menu, 'json', ['groups' => 'post:read']);
        return new Response("Menu deleted successfully" . json_encode($jsonContent));
    }
    /**
     * @Route("/updateJSON/{id}", name="app_categorie_updateCPJSON", methods={"PUT"})
     */
    public function updatePubJSON(Request $request,NormalizerInterface $normalizer, $id){
        $em = $this->getDoctrine()->getManager();
        $CategorieProduit = $em->getRepository(Equipe::class)->find($id);


        $CategorieProduit->setNom($request->get('nom'));
        $CategorieProduit->setClassement($request->get('classement'));

        $em->persist($CategorieProduit);
        $em->flush();
        $data=$normalizer->normalize($CategorieProduit,'json',['groups'=>'post:read']);

        return new Response(json_encode($data));
    }
    /**
     * @Route("/api/equipes", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $equipes = $this->getDoctrine()->getRepository(Equipe::class)->findAll();
        $data = [];

        foreach ($equipes as $equipe) {
            $data[] = [
                'id' => $equipe->getId(),
                'nom' => $equipe->getNom(),
                'classement' => $equipe->getClassement(),
                
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }



    /**
     * @Route("/api/add/equipe", name="add_equipe", methods={"POST"})
     */
    public function add(NormalizerInterface $Normalizer,Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);


        $em = $this->getDoctrine()->getManager();
        $Post = new Equipe();
        $Post->setNom($request->get('nom'));
        $Post->setClassement($request->get('classement'));
        
       // $Post->setUser($request->get('user_id'));
        $em->persist($Post);
        $em->flush();





        $jsonContent= $Normalizer->normalize($Post,'json',['groups'=>"produit:read"]);
       // return new Response(json_encode($jsonContent));;

        return new JsonResponse(['status' => 'equipe created!'], Response::HTTP_CREATED);
    }






    /**
     * @Route("api/equipe/edit/{id}", name="api_edit_equipe" ,  methods={"POST"})
     */
    public function edit(Request $request)//:JsonResponse
    {

        $id = $request->get("id");
        $nom = $request->query->get("nom");
        $classement = $request->query->get("classement");
        
       // $user = $request->query->get("user_id");

        $em = $this->getDoctrine()->getManager();
        $equipe = $em->getRepository(Equipe::class)->find($id);

        //return new JsonResponse(['status' => 'product updated!'], Response::HTTP_CREATED);

    }









    






}