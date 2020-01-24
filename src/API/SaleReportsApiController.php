<?php

namespace App\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SaleReportsApiController extends AbstractController
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    /**
     * @Route(
     *     name="potato sales",
     *     path="/api/sales/potato",
     *     methods={"GET"},
     * )
     */
    public function getPotatoSales(): object
    {
        $rootDir = $this->params->get('kernel.project_dir');
        $responseJson = file_get_contents($rootDir . '/staticres/potato_sales.json');

        return new JsonResponse(json_decode($responseJson, true));
    }
}