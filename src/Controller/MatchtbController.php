<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\MatchtbType;
use App\Entity\Matchtb;
use App\Entity\Participation;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class MatchtbController extends AbstractController
{
    /**
     * @Route("/matchtb", name="app_matchtb")
     */
    public function index(Request $request, EntityManagerInterface $em,  ): Response
    {
        $matchtb = new Matchtb();
        $matches = $em->getRepository(Matchtb::class)->findAll();


        $form = $this->createForm(MatchtbType::class, $matchtb);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $matchtb = $form->getData();
            $em->persist($matchtb);
            $em->flush();
            $this->addFlash('succée','match ajouté');
            return $this->redirect($request->getUri());

        }
        return $this->render('matchtb/index.html.twig', [
            'controller_name' => 'MatchtbController',
            'form' => $form->createView(),
            'matches' =>$matches
        ]);
    }
    /**
     * @Route("/matchtb/update/{id}", name="matchtb_update")
     */

     public function edit(Request $request, int $id, EntityManagerInterface $em, )
     {
         $matchtb = new Matchtb();
         $matches = $em->getRepository(Matchtb::class)->findAll();

         if ($id != null)
        {  
            $matchtb = $em->getRepository(Matchtb::class)->findOneById($id);
        
        }

        $form = $this->createForm(MatchtbType::class, $matchtb);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
   
            $em->persist($matchtb);
            $em->flush();
            return $this->redirect($request->getUri());
        }
        return $this->render('matchtb/index.html.twig', [
            'controller_name' => 'MatchtbController',
            'form' => $form->createView(),
            'matches' =>$matches,
            'matchtb' =>$matchtb,
            
        ]);
     }
         /**
     * @Route("/matchtb/delete/{id}", name="matchtb_delete")
     */

    public function delete(Request $request, int $id, EntityManagerInterface $em, )
    {
        $matchtb = new Matchtb();

        if ($id != null)
       {  
           
           $matchtb = $em->getRepository(Matchtb::class)->findOneById($id);
        
       }
       $prepo = $em->getRepository(Participation::class);
       $matchP = $prepo->findBy(["match" => $matchtb->getId()]);
       if (count($matchP)>0)
           {$this->addFlash('message',' match a déja affecté des participations');
           return $this->redirect('/matchtb');
           }
       $form = $this->createForm(MatchtbType::class, $matchtb);
        $em->remove($matchtb);
        $em->flush();
       $matches = $em->getRepository(Matchtb::class)->findAll();

       return $this->render('matchtb/index.html.twig', [
           'controller_name' => 'MatchtbController',
           'form' => $form->createView(),
           'matches' =>$matches,
           'matchtb' =>$matchtb,
           
       ]);
    }
     /**
     * @Route("/matchClient", name="app_matchClient")
     */
    public function vuClient(Request $request, EntityManagerInterface $em,  ): Response
    {
        $matchtb = new Matchtb();
        $matches = $em->getRepository(Matchtb::class)->findAll();

        return $this->render('matchtb/clientview.html.twig', [
            'controller_name' => 'MatchtbController',
            'matches' =>$matches
        ]);

}
}