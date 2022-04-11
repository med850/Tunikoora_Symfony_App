<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
