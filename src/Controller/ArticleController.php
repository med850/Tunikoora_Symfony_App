<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Review;
use App\Form\ArticleType;
use App\Form\ReviewType;
use App\Form\SearchType;
use App\Repository\ArticleRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use mofodojodino\ProfanityFilter\Check;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Twilio\Rest\Client;
class ArticleController extends AbstractController
{
    private $twilio;

    public function __construct(Client $twilio)
    {
        $this->twilio = $twilio;
    }
    /**
     * @Route("/app_article", name="app_article")
     */
    public function index(ArticleRepository $articleRepository): Response
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
            $message = $this->twilio->messages->create(
                '+21692881042', // Send text to this number
                array(
                    'from' => '+14454551924', // My Twilio phone number
                    'body' => 'Article ajouté avec succes  '
                )
            );
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

    /**
     * @Route("article/{id}", name="articleShow", methods={"GET", "POST"})
     */
    public function showArticle(Article $article, Request $request, ArticleRepository $articleRepository): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form -> handleRequest($request);
        if($form -> isSubmitted() && $form -> isValid()){
            $review -> setArticle($article);
            $entityMannager = $this->getDoctrine() -> getManager();
            $entityMannager -> persist($review);
            $entityMannager -> flush();

            return $this->redirectToRoute("articleShow", ['id' => $article -> getId()]);
        }
        return $this->render('review/displayReviewFront.html.twig', [
            'article' => $article,
            'review' => $form -> createView(),
        ]);
    }

    /**
     * @Route("/pdf", name="pdf")
     */
    public  function displayPDF()
    {
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $articles = $this->getDoctrine()->getManager()->getRepository(Article::class)->findAll();
        $html= $this->render('article/pdf.html.twig', [
            'articles'=>$articles
        ]);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }

    /**
     * @Route("/orderTitre", name="orderTitre")
     */

    function orderByTitre(ArticleRepository $repository, Request $request,ArticleRepository $T){

        $article=$repository->orderByTitre();
        $formsearchI = $this->createForm(SearchType::class);
        $formsearchI->handleRequest($request);
        if ($formsearchI->isSubmitted()) {
            $titre = $formsearchI->getData();
            $TSearch = $T->search($titre['titre']);

            return $this->render("article/index.html.twig",
                array("articles" => $TSearch,"formsearch" => $formsearchI->createView())) ;
        }
        return $this->render("article/index.html.twig",array('articles' => $article,
            "formsearch" => $formsearchI->createView()));

    }

    /**
     * @Route("/orderDate", name="orderDate")
     */

    function orderByDate(ArticleRepository $repository, Request $request,ArticleRepository $T){

        $article=$repository->orderByDate();
        $formsearchI = $this->createForm(SearchType::class);
        $formsearchI->handleRequest($request);
        if ($formsearchI->isSubmitted()) {
            $titre = $formsearchI->getData();
            $TSearch = $T->search($titre['titre']);

            return $this->render("article/index.html.twig",
                array("articles" => $TSearch,"formsearch" => $formsearchI->createView())) ;
        }
        return $this->render("article/index.html.twig",array('articles' => $article,"formsearch" => $formsearchI->createView()));

    }

    /**
     * @Route("/display_article",name="display_article")
     */
    public function list(Request $request,ArticleRepository $T)
    {
        $articles=$this->getDoctrine()->getRepository(Article::class)->findAll();
        $formsearchI = $this->createForm(SearchType::class);
        $formsearchI->handleRequest($request);
        if ($formsearchI->isSubmitted()) {
            $titre = $formsearchI->getData();
            $TSearch = $T->search($titre['titre']);

            return $this->render("article/index.html.twig",
                array("articles" => $TSearch,"formsearch" => $formsearchI->createView())) ;
        }
        return $this->render("article/index.html.twig",array('articles'=>$articles,"formsearch" => $formsearchI->createView()));
    }
    public function getUserName(ArticleRepository $A)
    {
        $article=$A->orderByDate();
        return $this->render("review/displayReviewFront.html.twig",array('article' => $article));

    }
}
