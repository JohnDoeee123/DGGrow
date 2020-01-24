<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }


    /**
     * @Route(
     *     name="default",
     *     path="/",
     *     methods={"GET"},
     * )
     */
    public function index()
    {
        //TODO extract to a service
        if ($this->session->get('username')) {
            return $this->render('dashboard.html.twig', [
                'pageName' => 'Dashboard',
                'fullName' => $this->session->get('fullName'),
                'customContentTemplate' => 'fragments/content/login_success.html.twig'
            ]);
        }

        return $this->render('base.html.twig');
    }
}
