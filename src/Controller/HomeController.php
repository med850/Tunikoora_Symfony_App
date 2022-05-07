<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EquipeRepository;

use App\Entity\Equipe;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(EquipeRepository $repository): Response
    {$equipes = $this->getDoctrine()->getManager()->getRepository(Equipe::class)->findAll();
        $equipes= $repository->orderByName();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',            
            'equipe'=>$equipes,

        ]);
    }




      /**
     * @Route("/auth", name="app_auth")
     */
    public function showAuth(): Response
    {
        return $this->render('home/authClient.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }



}
