<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Review;
use App\Form\ReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    /**
     * @Route("/review", name="app_review")
     */
    public function index(): Response
    {
        return $this->render('review/index.html.twig', [
            'controller_name' => 'ReviewController',
        ]);
    }

    /**
     * @Route("/addReview", name="addReview")
     */
    public function addReview(Request $request): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class,$review);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);//Add
            $em->flush();

            return $this->redirectToRoute('displayReviewFront');
        }
        return $this->render('review/createReview.html.twig',['form'=>$form->createView()]);

    }


    /**
     * @Route("/modifReview/{id}", name="modifReview")
     */
    public function updateReview(Request $request,$id): Response
    {
        $review = $this->getDoctrine()->getManager()->getRepository(Review::class)->find($id);

        $form = $this->createForm(ReviewType::class,$review);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('displayReviewFront');
        }
        return $this->render('review/updateReview.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/displayReviewFront", name="displayReviewFront")
     */
    public function displayReviewFront(): Response
    {
        $review = $this->getDoctrine()->getManager()->getRepository(Review::class)->findAll();
        $article = $this->getDoctrine()->getManager()->getRepository(Article::class)->findAll();
        return $this->render('review/displayReviewFront.html.twig', [
            'reviews'=>$review,
            'articles'=>$article
        ]);
    }

    /**
     * @Route("/supp_reviewFront/{id}", name="supp_reviewFront")
     */
    public function deleteReviewFront(Review  $review): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($review);
        $em->flush();

        return $this->redirectToRoute('displayReviewFront');
    }
}
