<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DummySecurityController extends AbstractController
{

    /**
     * @Route(
     *     name="login",
     *     path="/login",
     *     methods={"GET"},
     * )
     */
    public function login()
    {
        return $this->render('security/login.html.twig', [
        ]);
    }

}