<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PotatoHelperService;

class ProductController extends AbstractController
{
    private $potatoHelper;

    public function __construct(PotatoHelperService $potatoHelper)
    {
        $this->potatoHelper = $potatoHelper;
    }

    /**
     * @Route(
     *     name="newProduct",
     *     path="/newProduct",
     *     methods={"GET","POST"},
     * )
     */
    public function new()
    {
        if (!$this->potatoHelper->loggedInUserExists()) {
            return $this->redirectToRoute('default');
        }

        return $this->render('add_new_product.html.twig', $this->potatoHelper->getCurrentPageInfo());
    }

    /**
     * @Route(
     *     name="productSalesReport",
     *     path="/productSalesReport",
     *     methods={"GET"},
     * )
     */
    public function productSalesReport()
    {
        if (!$this->potatoHelper->loggedInUserExists()) {
            return $this->redirectToRoute('login');
        }

        return $this->render('sales_report.html.twig', $this->potatoHelper->getCurrentPageInfo());
    }

    /**
     * @Route(
     *     name="productDashboard",
     *     path="/productDashboard",
     *     methods={"GET"},
     * )
     */
    public function productDashboard()
    {
        if (!$this->potatoHelper->loggedInUserExists()) {
            return $this->redirectToRoute('login');
        }
        return $this->render('dashboard.html.twig',
            array_merge($this->potatoHelper->getCurrentPageInfo(), [
                'customContentTemplate' => 'fragments/content/login_success.html.twig']));
    }


}
