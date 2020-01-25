<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\Type\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route(
     *     name="newProduct",
     *     path="/newProduct",
     *     methods={"GET","POST"},
     * )
     */
    public function new(Request $request)
    {
        //TODO extract to a service
        if (!$this->session->get('username')) {
            return $this->redirectToRoute('default');
        }

        return $this->render('add_new_product.html.twig', [
            'pageName' => 'New Product',
            'fullName' => $this->session->get('fullName')
        ]);
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
        //TODO extract to a service
        if (!$this->session->get('username')) {
            return $this->redirectToRoute('login');
        }

        return $this->render('sales_report.html.twig', [
            'pageName' => 'Sales Report',
            'fullName' => $this->session->get('fullName')
        ]);
    }

}
