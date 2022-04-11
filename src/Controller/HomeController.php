<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
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
