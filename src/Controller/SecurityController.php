<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegisterClientType;

use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscriptionU", name="security_registration")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $encoder)
    { 
        
       
        $user = new Users();


        $form = $this->createForm(RegisterClientType::class, $user);


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){


            $hash = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $hashR = $encoder->encodePassword($user,$user->getRepeatpassword());
            $user->setRepeatpassword($hashR);

            $entityMannager = $this -> getDoctrine() -> getManager();
            $entityMannager -> persist($user);
            $entityMannager -> flush();
            //dump($user);die;
          // $flashyNotifier->success('Inscription Complete');
          
           return $this -> redirectToRoute("security_login");
        }

        return $this->render('security/registration.html.twig', [
            'form'=>$form->createView()
        ]);

    

    }


     /**
     * @Route("/loginU", name="security_login")
     */
    public function connexion(Request $request)
    { 
        return $this->render('security/login.html.twig');
   
        return $this -> redirectToRoute("app_home");
    }


     /**
     * @Route("/logoutU", name="security_logout")
     */
    public function déconnexion(Request $request)
    { 

       // return $this -> redirectToRoute("security_login");
        return $this->render('security/login.html.twig');
            


    }





}
