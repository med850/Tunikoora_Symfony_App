<?php

namespace App\Controller;

use App\Entity\Matchtb;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use App\Repository\MatchtbRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MatchtbAPIController extends AbstractController
{
    /**
     *@Route("/api/matchtb", name="get_all_customers", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $Matchtb = $this->getDoctrine()->getRepository(Matchtb::class)->findAll();
        $data = [];

        foreach ($Matchtb as $match) {
            $data[] = [
                'id' => $match->getId(),
                'localisation' => $match->getlocalisation(),
                'arbitrePrincipale' => $match->getarbitreprincipale(),
                'tour' => $match->gettour(),

            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }



    /**
     * @Route("/api/add/matchtb", name="add_match", methods={"POST"})
     */
    public function add(NormalizerInterface $Normalizer,Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);


        $em = $this->getDoctrine()->getManager();
        $Post = new Matchtb();
        $Post->setLocalisation($request->get('localisation'));
        $Post->setArbitreprincipale($request->get('arbitrePrincipale'));
        $Post->setTour($request->get('tour'));
                $em->persist($Post);
        $em->flush();





        $jsonContent= $Normalizer->normalize($Post,'json',['groups'=>"matchtb:read"]);
       // return new Response(json_encode($jsonContent));;

        return new JsonResponse(['status' => 'match créeé!'], Response::HTTP_CREATED);
    }






    /**
     * @Route("api/matchtb/edit/{id}", name="api_edit_match" ,  methods={"POST"})
     */
    public function edit(Request $request)//:JsonResponse
    {

        $id = $request->get("id");
        $localisation = $request->query->get("localisation");
        $arbitreprincipale = $request->query->get("arbitrePrincipale");
        $tour = $request->query->get("tour");
        
       // $user = $request->query->get("user_id");

        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository(Matchtb::class)->find($id);

        //return new JsonResponse(['status' => 'match updated!'], Response::HTTP_CREATED);

    }









    /**
     * @Route("/api/match/delete/{id}", name="delete_match", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $entityManager->getRepository(matchtb::class)->find($id);

        $entityManager->remove($user);
        $entityManager->flush();

        return new JsonResponse(['status' => 'match supprime'], Response::HTTP_NO_CONTENT);
    }






}
