<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Review;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/app_article", name="app_article")
     */
    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    /**
     * @Route("/addArticle", name="addArticle")
     */
    public function addArticle(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            foreach($image as $ima){
                $fichier = md5(uniqid()) . '.' . $ima->guessExtension();
                $ima->move(
                    $this->getParameter('img_directory'),
                    $fichier
                );
            }
            $em = $this->getDoctrine()->getManager();
            $article->setImage($fichier);
            $em->persist($article);//Add
            $em->flush();

            return $this->redirectToRoute('display_article');
        }
        return $this->render('article/createBlog.html.twig',['form'=>$form->createView()]);

    }
    /**
     * @Route("/display_article", name="display_article")
     */
    public function displayArticle(): Response
    {
        $articles = $this->getDoctrine()->getManager()->getRepository(Article::class)->findAll();
        return $this->render('article/index.html.twig', [
            'articles'=>$articles
        ]);
    }

    /**
     * @Route("/removeArticle/{id}", name="supp_article")
     */
    public function deleteArticle(Article  $article): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('display_article');


    }
    /**
     * @Route("/modifArticle/{id}", name="modifArticle")
     */
    public function updateArticle(Request $request,$id): Response
    {
        $article = $this->getDoctrine()->getManager()->getRepository(Article::class)->find($id);

        $form = $this->createForm(ArticleType::class,$article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            foreach($image as $ima){
                $fichier = md5(uniqid()) . '.' . $ima->guessExtension();
                $ima->move(
                    $this->getParameter('img_directory'),
                    $fichier
                );
            }
            $em = $this->getDoctrine()->getManager();
            $article->setImage($fichier);
            $em->flush();

            return $this->redirectToRoute('display_article');
        }
        return $this->render('article/updateArticle.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/display", name="display")
     */
    public function displayArticleFront(): Response
    {
        $articles = $this->getDoctrine()->getManager()->getRepository(Article::class)->findAll();
        return $this->render('article/displayArticleFront.html.twig', [
            'articles'=>$articles
        ]);
    }

}
