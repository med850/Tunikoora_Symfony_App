<?php

namespace App\Controller;

use App\Entity\Livraison;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\LivraisonRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class LivApiController extends AbstractController
{
    /**
     * @Route("/api/Livraisons", name="get_all_liv", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $livraisons = $this->getDoctrine()->getRepository(Livraison::class)->findAll();
        $data = [];

        foreach ($livraisons as $livraison) {
            $data[] = [
                'id' => $livraison->getId(),
                'ref' => $livraison->getRef(),
                'localisation' => $livraison->getLocalisation(),
                'etat' => $livraison->getEtat(),
                'user_id' => $livraison->getUser(),
                'datesortie' => $livraison->getDatesortie(),

            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }



    /**
     * @Route("/api/add/livraison", name="add_livraison", methods={"POST"})
     */
    public function add(NormalizerInterface $Normalizer,Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);


        $em = $this->getDoctrine()->getManager();
        $Post = new Livraison();
        $Post->setRef($request->get('ref'));
        $Post->setLocalisation($request->get('localisation'));
        $Post->setEtat($request->get('etat'));
        //$Post->setUser($request->get('user_id'));
        //$Post->setDatesortie($request->get('datesortie'));
        // $Post->setUser($request->get('user_id'));
        $em->persist($Post);
        $em->flush();





        $jsonContent= $Normalizer->normalize($Post,'json',['groups'=>"livraison:read"]);
        // return new Response(json_encode($jsonContent));;

        return new JsonResponse(['status' => 'livraison crée!'], Response::HTTP_CREATED);
    }






    /**
     * @Route("api/livraisons/edit/{id}", name="api_edit_Livraison" ,  methods={"POST"})
     */
    public function edit(Request $request)//:JsonResponse
    {

        $id = $request->get("id");
        $ref = $request->query->get("ref");
        $localisation = $request->query->get("localisation");
        $etat = $request->query->get("etat");
        $user = $request->query->get("user");
        $datesortie = $request->query->get("datesortie");
        // $user = $request->query->get("user_id");

        $em = $this->getDoctrine()->getManager();
        $livraison = $em->getRepository(Livraison::class)->find($id);

        //return new JsonResponse(['status' => 'livraison updated!'], Response::HTTP_CREATED);

    }









    /**
     * @Route("/api/livraisons/delete/{id}", name="delete_livraison", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $entityManager->getRepository(Livraison::class)->find($id);

        $entityManager->remove($user);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Livraison deleted'], Response::HTTP_NO_CONTENT);
    }

}
