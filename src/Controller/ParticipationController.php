<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ParticipationType;
use App\Entity\Participation;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Form\FormError;
class ParticipationController extends AbstractController
{
    /**
     * @Route("/participation", name="app_participation")
     */
    public function index(Request $request,EntityManagerInterface $em,SerializerInterface $serializer): Response
    {
        $repo = $em->getRepository(Participation::class);
        $participation = new Participation();
        $participations = $repo->findAll();
        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);
        $error = null;

        if ($form->isSubmitted() && $form->isValid())
        {
            if ($participation->getEquipe()->getId() == $participation->getEquipe2()->getId())
             {   
                 $error = new FormError("error, can't have the same team in pariticpation");
                $form->get('equipe')->addError($error);
                $form->get('equipe2')->addError($error);

            }
            $date =$participation->getDate();
            $p1 = $repo->findOneBy(["date"=>$date, "equipe" => $participation->getEquipe()->getId()]);
            $p2 = $repo->findOneBy(["date"=>$date, "equipe2" => $participation->getEquipe2()->getId()]);
            if ($p1 != null || $p2!= null)
            {
                $error = new FormError("can't have the team playing two matches in the same day");
                $form->get('date')->addError($error);
            }
            if ($participation->getDate() < new \DatetimeImmutable())
            {
                $error = new FormError("Please enter date greater than today");
                $form->get('date')->addError($error);    
            }
            if (!$error)
            {
                $participation = $form->getData();
                $em->persist($participation);
                $em->flush();
                return $this->redirect($request->getUri());
            }


        }
        $json = $serializer->serialize($participations,'json');
        return $this->render('participation/index.html.twig', [
            'controller_name' => 'ParticipationController',
            'form' => $form->createView(),
            'participations' => $participations,
            'parts' =>$json
        ]);
    }

         /**
     * @Route("/participation/delete/{id}", name="participation_delete")
     */
   public function delete(Request $request, int $id, EntityManagerInterface $em)
    {
        $participation = new participation();
        $repo = $em->getRepository(Participation::class);

        if ($id != null)
       {  
           
      $participation = $em->getRepository(Participation::class)->find($id);
       
       }
       $form = $this->createForm(ParticipationType::class, $participation);
        $em->remove($participation);
        $em->flush();
       $matches = $em->getRepository(participation::class)->findAll();
        return $this->redirect('/participation');
 /*       return $this->render('participation/index.html.twig', [
           'controller_name' => 'ParticipationController',
           'form' => $form->createView(),
           'participations' =>$repo->findAll(),
           'participation' =>$participation,
           
       ]); */
    }
    /**
     * @Route("/participationClient", name="app_participationClient")
     */
    public function partclientview(Request $request,EntityManagerInterface $em,SerializerInterface $serializer): Response
    {
        $repo = $em->getRepository(Participation::class);
        $participations = $repo->findAll();
        $json = $serializer->serialize($participations,'json');

        return $this->render('participation/clientview.html.twig', [
            'controller_name' => 'ParticipationController',
            'participations' =>$participations,
            'parts' =>$json
        ]);
        
}
}
