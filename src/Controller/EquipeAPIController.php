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
     * @Route("/api/equipes", name="get_all_customers", methods={"GET"})
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









    /**
     * @Route("/api/equipe/delete/{id}", name="delete_equipe", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $entityManager->getRepository(equipe::class)->find($id);

        $entityManager->remove($user);
        $entityManager->flush();

        return new JsonResponse(['status' => 'equipe deleted'], Response::HTTP_NO_CONTENT);
    }






}
