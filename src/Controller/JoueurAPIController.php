<?php

namespace App\Controller;

use App\Entity\Joueur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\JoueurRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class JoueurAPIController extends AbstractController
{
    /**
     * @Route("/api/joueurs", name="get_all_customers", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $joueurs = $this->getDoctrine()->getRepository(Joueur::class)->findAll();
        $data = [];

        foreach ($joueurs as $joueur) {
            $data[] = [
                'id' => $joueur->getId(),
                'nom' => $joueur->getNom(),
                'prenom' => $joueur->getPrenom(),
                'poste' => $joueur->getPoste(),
                'tel' => $joueur->getTel(),
                'equipe' => $joueur->getEquipe(),
                'nb_but' => $joueur->getNb_but(),
                'image' => $joueur->getImage(),


                
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }



    /**
     * @Route("/api/add/joueur", name="add_joueur", methods={"POST"})
     */
    public function add(NormalizerInterface $Normalizer,Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);


        $em = $this->getDoctrine()->getManager();
        $Post = new Joueur();
        $Post->setNom($request->get('nom'));
        $Post->setPrenom($request->get('prenom'));
        $Post->setPoste($request->get('poste'));
        $Post->setTel($request->get('tel'));
        $Post->setEquipe($request->get('equipe'));
        $Post->setNb_but($request->get('nb_but'));
        $Post->setImage($request->get('image'));
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
        $prenom = $request->query->get("prenom");
        $poste = $request->query->get("poste");
        $tel = $request->query->get("tel");
        $equipe = $request->query->get("equipe");
        $nb_but = $request->query->get("nb_but");
        $image = $request->query->get("image");



        
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
