<?php

namespace App\Controller\API;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Annotation\ApiResource;

class ApiResponseController
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    /**
     * @Route(
     *     name="potato sales",
     *     path="/api/potatoSales",
     *     methods={"GET"},
     * )
     */
    public function __invoke(): object
    {
        $rootDir = $this->params->get('kernel.project_dir');
        $responseJson = file_get_contents($rootDir . '/staticres/potato_sales.json');

        return new JsonResponse(json_decode($responseJson, true));
    }
}