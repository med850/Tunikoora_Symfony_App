<?php

namespace App\Controller;

use App\Services\CallApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EquipeRepository;

use App\Entity\Equipe;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{



    /**
     * @Route("/", name="app_home")
     */
    public function index(EquipeRepository $repository, CallApiService $callApiService): Response
    {$equipes = $this->getDoctrine()->getManager()->getRepository(Equipe::class)->findAll();
        $equipes= $repository->orderByName();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',            
            'equipe'=>$equipes,
            'data' => $callApiService->getDataTunisia(),
            'dataW' => $callApiService->getDataWorld(),
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
