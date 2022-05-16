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
     * @Route("/api/addArticle", name="add_article", methods={"POST"})
     */
    public function add(NormalizerInterface $Normalizer,Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);


        $em = $this->getDoctrine()->getManager();
        $Post = new Article();
        $Post->setTitre($request->get('titre'));
        $Post->setDescription($request->get('description'));
        //$Post->setImage($request->get('image'));
        //$Post->setDate($request->get('date'));
        $em->persist($Post);
        $em->flush();


        $jsonContent= $Normalizer->normalize($Post,'json',['groups'=>"article:read"]);
        return new JsonResponse(['status' => 'article created!'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/showArticle", name="showArticle")
     */
    public function showArticle(NormalizerInterface $Normalizer)
    {
        $menus = $this->getDoctrine()->getRepository(Article::class)->findAll();
        $jsonContent = $Normalizer->normalize($menus, 'json', ['groups' => 'post:read']);
        return new Response(json_encode($jsonContent));
    }
    /**
     * @Route("/deleteArticle/{id}", name="deleteArticle")
     */
    public function deleteArticle($id, NormalizerInterface $Normalizer)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository(Article::class)->find($id);
        $em->remove($menu);
        $em->flush();
        $jsonContent = $Normalizer->normalize($menu, 'json', ['groups' => 'post:read']);
        return new Response("Menu deleted successfully" . json_encode($jsonContent));
    }



}