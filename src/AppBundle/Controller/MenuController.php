<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Products;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends Controller
{
    /**
     * @Route("/menu", name="menu")
     */
    public function indexAction()
    {

       $products = $this->getDoctrine()
           ->getRepository('AppBundle:Products')
           ->findAll();

        return $this->render('menu/index.html.twig', array(
            'products'=>$products,
        ));
    }

    /**
     * @Route("menu/{id}", name = "product_show")
     */
    public function productAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Products')
            ->find($id);

        return $this->render('menu/product.html.twig', array(
            'product'=>$product,
        ));
    }
}