<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ArticleApiController extends AbstractController
{
    /**
     * @Route("/api/article", name="get_all_customers", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->findAll();
        $data = [];

        foreach ($article as $a) {
            $data[] = [
                'id' => $a->getId(),
                'titre' => $a->getTitre(),
                'description' => $a->getDescription(),
                'image' => $a->getImage(),
                'date' => $a->getDate(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }



    /**
     * @Route("/api/add/article", name="add_article", methods={"POST"})
     */
    public function add(NormalizerInterface $Normalizer,Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);


        $em = $this->getDoctrine()->getManager();
        $Post = new Article();
        $Post->setTitre($request->get('titre'));
        $Post->setDescription($request->get('description'));
        $Post->setImage($request->get('image'));
        //$Post->setDate($request->get('date'));
        $em->persist($Post);
        $em->flush();


        $jsonContent= $Normalizer->normalize($Post,'json',['groups'=>"article:read"]);
        return new JsonResponse(['status' => 'article created!'], Response::HTTP_CREATED);
    }


    /**
     * @Route("api/article/edit/{id}", name="api_edit_article" ,  methods={"POST"})
     */
    public function edit(Request $request)//:JsonResponse
    {

        $id = $request->get("id");
        $titre = $request->query->get("titre");
        $description = $request->query->get("description");
        $image = $request->query->get("image");
        $date = $request->query->get("date");

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->find($id);



    }

    /**
     * @Route("/api/article/delete/{id}", name="delete_article")
     */
    public function delete($id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();

        $article = $entityManager->getRepository(Article::class)->find($id);

        $entityManager->remove($article);
        $entityManager->flush();
    }



}
