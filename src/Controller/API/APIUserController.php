<?php

namespace App\Controller\API;

use App\Entity\User;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class APIUserController extends AbstractController
{
//    /**
//     * @Route("/api/user", name="apiUserList")
//     */
//    public function index()
//    {
//        return $this->render('user/index.html.twig', [
//            'controller_name' => 'UserController',
//        ]);
//    }

    // /**
    //  * @Route("/register", name="UserRegister")
    //  */
    // public function apiRegister(Request $request, UserPasswordEncoderInterface $encoder)
    // {
    //     $em = $this->getDoctrine()->getManager();
    //     $username = $request->request->get('_username');
    //     $password = $request->request->get('_password');
    //     $user = new User($username);
    //     $user->setPassword($encoder->encodePassword($user, $password));
    //     $em->persist($user);
    //     $em->flush();
    //     return new Response(sprintf('User %s successfully created', $user->getUsername()));
    // }

    /**
     * @Route("/api/user/register", name="apiUserRegister", format="json")
     * @return JsonResponse
     */
    public function apiUserRegister(Request $request, UserPasswordEncoderInterface $encoder, LoggerInterface $logger): JsonResponse
    {

        $em = $this->getDoctrine()->getManager();
        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $email = $request->request->get('email');

        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setActive(false);
//

        $em->persist($user);
        $em->flush();
        return $this->json(sprintf('User %s successfully created', $user->getUsername()));
    }

    /**
     *
     * @Route("/api/user/get", name="apiUserGet")
     * @return JsonResponse
     */
    public function apiGetUser(): JsonResponse
    {
        return $this->json($this->getUser());
    }

}
