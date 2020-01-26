<?php

namespace App\Controller;

use App\Service\PotatoHelperService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController
{
    private $potatoHelper;

    public function __construct(PotatoHelperService $potatoHelper)
    {
        $this->potatoHelper = $potatoHelper;
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
        if ($this->potatoHelper->loggedInUserExists()) {
            return $this->render('dashboard.html.twig', array_merge($this->potatoHelper->getCurrentPageInfo(),
                ['customContentTemplate' => 'fragments/content/login_success.html.twig']
            ));
        }

        return $this->render('base.html.twig');
    }
}
