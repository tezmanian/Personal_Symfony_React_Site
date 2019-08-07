<?php

namespace App\Controller\API;

use App\Entity\User;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\{HttpFoundation\JsonResponse,
    HttpFoundation\Request,
    Routing\Annotation\Route,
    Security\Core\Encoder\UserPasswordEncoderInterface};

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


    /**
     * @Route("/api/user/register", name="apiUserRegister", format="json")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param LoggerInterface $logger
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

        $em->persist($user);
        $em->flush();
        $logger->info(sprintf('Added user %s successful', $user->getUsername()));
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
