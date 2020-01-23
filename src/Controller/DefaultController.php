<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController
{
    /**
     * @Route(
     *     name="default",
     *     path="/",
     *     methods={"GET"},
     * )
     */
    public function index()
    {
        return $this->render('base.html.twig');
    }
}
