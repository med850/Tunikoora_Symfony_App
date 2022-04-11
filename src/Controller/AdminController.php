<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\EditUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class AdminController extends AbstractController
{

     /**
     * @Route("/admin_auth", name="security_admin")
     */
    public function show(): Response
    {
        return $this->render('admin/auth.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }




   
     /**
     * @Route("admin/login", name="security_login_admin")
     */
    public function connexionAdmin(Request $request)
    { 

       
        return $this->render('admin/auth.html.twig');
        
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this -> redirectToRoute("app_dashboard");
         }
        
    }






        /**
     * @Route("/admin", name="app_dashboard")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }



    /**
     * @Route("admin/utilisateurs", name="utilisateurs")
     */
    public function userList(){

        $users = $this->getDoctrine()->getRepository(Users::class)->findAll();

        

        return $this->render('admin/users.html.twig', [
          
            'users'=>$users
        ]);
    }


    #[IsGranted('ROLE_ADMIN')]
      /**
     * @Route("utilisateurs/modifier/{id}", name="modify_user")
     */
    public function editUser(Users $user, Request $request){

        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);  
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
                    
           return $this -> redirectToRoute("app_dashboard");
        }

        return $this->render('admin/editUser.html.twig', [
            'userForm'=>$form->createView()
        ]);

    

    }

  






}
