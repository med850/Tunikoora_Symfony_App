<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeFormType;
use App\Repository\EquipeRepository;
use App\Form\SearchType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use MercurySeries\FlashyBundle\FlashyNotifier;
use Knp\Component\Pager\PaginatorInterface;

class EquipeController extends AbstractController
{
    /**
     * @Route("/equipe", name="ajouter_equipe")
     */
    public function index(): Response
    {        

        return $this->render('admin/ajouterEquipe.html.twig', [
            'controller_name' => 'EquipeController',
        ]);
    }
    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/victory/{id}", name="ajouter3")
     */
    public function victory(Equipe $equipe){
        {  

            $equipe->setClassement($equipe->getClassement() + 3);
            
            $em = $this->getDoctrine()->getManager();
            $em -> persist($equipe);
            $em->flush();
            
            return $this->redirectToRoute('display_equipe');        
        }
    }
    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/draw/{id}", name="null3")
     */
    public function draw(Equipe $equipe){
        {  

            $equipe->setClassement($equipe->getClassement() + 1);
            
            $em = $this->getDoctrine()->getManager();
            $em -> persist($equipe);
            $em->flush();
            
            return $this->redirectToRoute('display_equipe');        
        }
    }
    
    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/defeat/{id}", name="sub3")
     */
    public function defeat(Equipe $equipe){
        {  

            $equipe->setClassement($equipe->getClassement() - 3);
            
            $em = $this->getDoctrine()->getManager();
            $em -> persist($equipe);
            $em->flush();
            
            return $this->redirectToRoute('display_equipe');        
        }
    }
        
     /**
             * @Route("/orderName", name="order_by_name")
             */

            function orderByName(EquipeRepository $repository, Request $request,PaginatorInterface $paginator){

                {   $donnes= $repository->orderByName();

                    $equipes = $paginator->paginate(
                    $donnes,
                    $request->query->getInt('page',1),
                    3
                );
                    
                    return $this->render('admin/listEquipe.html.twig', [
                        'equipe'=>$equipes
                    ]);
                }
        
        
                }
     /**
      *  @IsGranted("ROLE_ADMIN")
     * @Route("/addEquipe", name="addEquipe")
     */
    public function addEquipe( Request $request): Response
    {
        $equipe = new Equipe();
        

        $form = $this->createForm(EquipeFormType::class,$equipe);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipe);//Add
            $em->flush();
           

            return $this->redirectToRoute('display_equipe');
        }
        return $this->render('admin/ajouterEquipe.html.twig',['form'=>$form->createView()]);

    }
   
    /**
     * @Route("/listE", name="List_equipe")
     */
    public function listE(): Response
    { $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $equipes = $this->getDoctrine()->getManager()->getRepository(Equipe::class)->findAll();
           
        
        // Retrieve the HTML generated in our twig file
        $html = $this->render('admin/listE.html.twig',['equipe'=>$equipes]);
        
        // Load HTML to Dompdf
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
     * @Route("/listEquipe", name="display_equipe")
     */
    public function displayEquipe(PaginatorInterface $paginator,EquipeRepository $T,Request $request): Response
    {   $donnes= $T->findAll();
    
        $equipes = $paginator->paginate(
        $donnes,
        $request->query->getInt('page',1),
        2
    );
    $formsearchI = $this->createForm(SearchType::class);
        $formsearchI->handleRequest($request);
        if ($formsearchI->isSubmitted()) {
            $nom = $formsearchI->getData();
            $TSearch = $T->search($nom['nom']);
            $searchequipe = $paginator->paginate(
                $TSearch,
                $request->query->getInt('page',1),
                2
            );
            
           return $this->render("admin/listEquipe.html.twig",
                array("equipe" => $searchequipe,"formsearch" => $formsearchI->createView())) ;
        }
        return $this->render("admin/listEquipe.html.twig",array('equipe'=>$equipes,"formsearch" => $formsearchI->createView()));
    }

    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/removeEquipe/{id}", name="supp_equipe")
     */
    public function deleteEquipe(Equipe  $equipe): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($equipe);
        $em->flush();

        return $this->redirectToRoute('display_equipe');


    }
    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/modifEquipe/{id}", name="modifEquipe")
     */
    public function updateEquipe(Request $request,$id): Response
    {
        $equipe = $this->getDoctrine()->getManager()->getRepository(Equipe::class)->find($id);

        $form = $this->createForm(EquipeFormType::class,$equipe);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('display_equipe');
        }
        return $this->render('admin/modifierEquipe.html.twig',['form'=>$form->createView()]);




    }
    
}
