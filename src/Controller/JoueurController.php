<?php

namespace App\Controller;

use App\Entity\Joueur;
use App\Form\JoueurFormType;
use App\Form\SearchType;

use App\Repository\JoueurRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


use Dompdf\Dompdf;
use Dompdf\Options;

class JoueurController extends AbstractController
{
    /**
     * @Route("/joueur", name="app_joueur")
     */
    public function index(): Response
    {        

        return $this->render('joueur/index.html.twig', [
            'controller_name' => 'JoueurController',
        ]);
    }
    /**
     * @Route("/chartjs", name="chartjs")
     */
    public function chart(): Response
    {        

        $joueurs = $this->getDoctrine()->getManager()->getRepository(Joueur::class)->findAll();
        return $this->render('admin/chartjs.html.twig', [
            'joueur'=>$joueurs
        ]);
    }
    
    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/addJoueur", name="addJoueur")
     */
    public function addJoueur(Request $request): Response
    {
        $joueur = new Joueur();

        $form = $this->createForm(JoueurFormType::class,$joueur);

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
            $joueur->setImage($fichier);

            
            $em->persist($joueur);//Add
            $em->flush();

            return $this->redirectToRoute('display_joueur');
        }
        return $this->render('admin/ajouterJoueur.html.twig',['form'=>$form->createView()]);

    }
    /**
             * @Route("/orderName1", name="order_by_name1")
             */

            function orderByName1(JoueurRepository $repository, Request $request,PaginatorInterface $paginator)
            

                {   $donnes= $repository->orderByName1();

                    $joueurs = $paginator->paginate(
                    $donnes,
                    $request->query->getInt('page',1),
                    2
                );
                    
                    return $this->render('admin/listJoueur.html.twig', [
                        'joueur'=>$joueurs
                    ]);
                }
        
        /**
     * @Route("/chart_js", name="chart_js")
     */
    public function chartj(): Response
    {   $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $joueurs = $this->getDoctrine()->getManager()->getRepository(Joueur::class)->findAll();
           
        
        // Retrieve the HTML generated in our twig file
        $html = $this->render('admin/chartjs.html.twig',['joueur'=>$joueurs]);
        
        // Load HTML to Dompdf
        $html .= '<link type="text/css" href="/absolute/path/to/pdf.css" rel="stylesheet" />';
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    
       

    }
                
    /**
     * @Route("/listj", name="List_joueur")
     */
    public function listj(): Response
    {   $pdfOptions = new Options();
        $pdfOptions->set('isRemoteEnabled', true);
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $joueurs = $this->getDoctrine()->getManager()->getRepository(Joueur::class)->findAll();
           
        
        // Retrieve the HTML generated in our twig file
        $html = $this->render('admin/listJ.html.twig',['joueur'=>$joueurs]);
        
        // Load HTML to Dompdf
        $html .= '<link type="text/css" href="/absolute/path/to/pdf.css" rel="stylesheet" />';
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    
       

    }
    /**
     * @IsGranted("ROLE_ADMIN")

     * @Route("/display_joueur", name="display_joueur")
     */
    public function displayJoueur(PaginatorInterface $paginator,JoueurRepository $T,Request $request): Response
    {$donnes= $T->findAll();
    
        $joueurs = $paginator->paginate(
        $donnes,
        $request->query->getInt('page',1),
        2
    );
    $formsearchI = $this->createForm(SearchType::class);
        $formsearchI->handleRequest($request);
        if ($formsearchI->isSubmitted()) {
            $nom = $formsearchI->getData();
            $TSearch = $T->search($nom['nom']);
            $searchjoueur = $paginator->paginate(
                $TSearch,
                $request->query->getInt('page',1),
                2
            );
            
           return $this->render("admin/listJoueur.html.twig",
                array("joueur" => $searchjoueur,"formsearch" => $formsearchI->createView())) ;
        }
        return $this->render("admin/listJoueur.html.twig",array('joueur'=>$joueurs,"formsearch" => $formsearchI->createView()));

    }
     /**
     * @Route("/view_joueur", name="view_joueur")
     */
    public function viewJoueur(): Response
    {
        $joueurs = $this->getDoctrine()->getManager()->getRepository(Joueur::class)->findAll();
        return $this->render('admin/displayJoueurFront.html.twig', [
            'joueur'=>$joueurs
        ]);
    }


    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/removeJoueur/{id}", name="supp_joueur")
     */
    public function deleteJoueur(Joueur  $joueur): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($joueur);
        $em->flush();

        return $this->redirectToRoute('display_joueur');


    }
    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/modifJoueur/{id}", name="modifJoueur")
     */
    public function updateJoueur(Request $request,$id): Response
    {
        $joueur = $this->getDoctrine()->getManager()->getRepository(Joueur::class)->find($id);

        $form = $this->createForm(JoueurFormType::class,$joueur);

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
            $joueur->setImage($fichier);

            
            $em->persist($joueur);//Add
            $em->flush();

            return $this->redirectToRoute('display_joueur');
        }
        return $this->render('admin/modifierJoueur.html.twig',['form'=>$form->createView()]);




    }
    /**
     * @Route("/listactf",name="listactualitesf")
     */
    public function list(Request $request,JoueurRepository $T,PaginatorInterface $paginator)
    {
        $joueur=$this->getDoctrine()->getRepository(Joueur::class)->findAll();
        
        
        //$C=$this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $formsearchI = $this->createForm(SearchType::class);
        $formsearchI->handleRequest($request);
        if ($formsearchI->isSubmitted()) {
            $nom = $formsearchI->getData();
            $TSearch = $T->search($nom['nom']);
            
           return $this->render("admin/listPlayer.html.twig",
                array("joueur" => $TSearch,"formsearch" => $formsearchI->createView())) ;
        }
        return $this->render("admin/listPlayer.html.twig",array('joueur'=>$joueur,"formsearch" => $formsearchI->createView()));


    }
}
