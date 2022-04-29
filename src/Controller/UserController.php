<?php

namespace App\Controller;

use App\Form\EditProfileType;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="app_profile")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }


     /**
     * @Route("/profile/modifier", name="app_modifier_profile")
     */
    public function editProfile(Request $request, FlashyNotifier $flashyNotifier)
    {

        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class,$user);
      //  $old_password = $user->getPassword();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          //  $user -> setCreatedDate(new DateTime());

            $em =$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $flashyNotifier->success('Succes');
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('user/editProfile.html.twig', [
            'form' => $form->createView(),
        ]);
    }


      /**
     * @Route("/profile/pass/modifier", name="app_modifier_pass")
     */
    public function editPass(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, FlashyNotifier $flashyNotifier)
    {



        if($request->isMethod('Post')){

            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();

            if($request->request->get('pass') == $request->request->get('pass2')){

                $user->setPassword($userPasswordEncoder->encodePassword($user,$request->request->get('pass')));
                $user->setRepeatpassword($userPasswordEncoder->encodePassword($user,$request->request->get('pass2')));
                $em->flush();
                $flashyNotifier->success('Succes');
                return $this->redirectToRoute('app_profile');    
                dd($user);
            }
        }

        return $this->render('user/editPass.html.twig', [
        ]);
    }








      /**
     * @Route("/profile/data/download", name="app_download_data")
     */
    public function useDataDownload()
    {
        $dompdf = new Dompdf();
        $pdfOptions = $dompdf->getOptions();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(true);

        $dompdf->setOptions($pdfOptions);
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);

        $dompdf->setHttpContext($context);

        $html = $this->renderView('user/userData.html.twig');

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();

        $fichier = 'user-data'. $this->getUser()->getId() .'pdf';

        $dompdf->stream($fichier, [
            'Attachement' => true
        ]);

        return new Response();
    }







}
