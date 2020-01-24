<?php

namespace App\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductApiController extends AbstractController
{
    /**
     * @Route(
     *     name="product",
     *     path="/api/product",
     *     methods={"POST"}
     * )
     */
    public function postProduct()
    {
        $response=["result"=>"Data was validated"];
        return new JsonResponse($response);
    }
}
