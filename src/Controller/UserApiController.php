<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UserApiController extends AbstractController
{
    /**
     * @Route("api/user/inscription", name="api_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
       
        $cin = $request->query->get("cin");
        $prenom = $request->query->get("prenom");
        $tel = $request->query->get("tel");
        $email = $request->query->get("email");
        $password = $request->query->get("password");
        $repeatPassword = $request->query->get("repeatpassword");
        $username = $request->query->get("username");
       // $roles = $request->query->get("roles");




        $user = new Users();
        $user->setCin($cin);
        $user->setUsername($username);
        $user->setPrenom($prenom);
        $user->setTel($tel);
        $user->setEmail($email);
        $user->setPassword(
            $encoder->encodePassword($user,$password)
        );
        $user->setRepeatpassword(
            $encoder->encodePassword($user, $repeatPassword)
        );
        //$user->setRoles(array($roles));


        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){


            return new Response("email invalide");
        }


        try{

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            return new JsonResponse("Compte creé avec succés", 200);
        }catch(\Exception $ex){

            return new Response("exception".$ex->getMessage());
        }


    }





        /**
 * @Route("api/login", name="api_login", methods={"GET"})
 */
public function login(Request $request)
{
  
    $email = $request->query->get("email");
    $password = $request->query->get("password");

    $em = $this->getDoctrine()->getManager();
    $user = $em->getRepository(Users::class)->findOneBy(['email'=>$email]);

    if($user){

        if(password_verify($password, $user->getPassword())){

            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($user);
            return new JsonResponse($formatted);


        } else{
            return new Response("Password not found");
        }
    }else{
        return new Response("User not found");
    }

}


    /**
 * @Route("api/user/listes", name="api_get_all_users", methods={"GET"})
 */
public function getAll(): JsonResponse
{
    $users = $this->getDoctrine()->getRepository(Users::class)->findAll();
    $data = [];

    foreach ($users as $user) {
        $data[] = [
            'id' => $user->getId(),
            'Cin' => $user->getCin(),
            'username' => $user->getUsername(),
            'prenom' => $user->getPrenom(),
            'tel' => $user->getTel(),
            'email' => $user->getEmail(),



        ];
    }

    return new JsonResponse($data, Response::HTTP_OK);
}





/**
 * @Route("api/users/delete/{id}", name="api_delete_user", methods={"DELETE"})
 */
public function delete($id): JsonResponse
{
    $entityManager = $this->getDoctrine()->getManager();

     $user = $entityManager->getRepository(Users::class)->find($id);

     $entityManager->remove($user);
    $entityManager->flush();

    return new JsonResponse(['status' => 'User deleted'], Response::HTTP_NO_CONTENT);
}



/**
 * @Route("api/users/edit", name="api_edit_user")
 */
public function edit(Request $request)
{

    $id = $request->get("id");
    $cin = $request->query->get("cin");
    $username = $request->query->get("username");
    $prenom = $request->query->get("prenom");
    $tel = $request->query->get("tel");
    $email = $request->query->get("email");

    $em = $this->getDoctrine()->getManager();
    $user = $em->getRepository(Users::class)->find($id);


}











}
