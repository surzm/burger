<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Basket;
use AppBundle\Entity\Products;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BasketController extends Controller
{
    /**
     * @Route("/basket", name="basket")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $session_id = $session->getId();

        $basketRows = $this->getDoctrine()
            ->getRepository('AppBundle:Basket')
            ->findByIdSession($session_id);


        function total($products)
        {
            $total=0;
            foreach ($products as $product) {
                $total += ($product->getProducts()->getPrice() * $product->getCount());
            };
            return $total;

        };
        $sum=total($basketRows);
        $session->set('total',$sum);

            return $this->render('basket/index.html.twig', array(
                'basketRows' => $basketRows,
                'total' => $sum,
            ));

    }

    /**
     * @param Request $request
     * @param $id
     * @Route("/add{id}", name="add_basket")
     */
    public function addAction(Request $request, $id)
    {
        $session = $request->getSession();
        $session_id = $session->getId();
        $add = $this->getDoctrine()->getManager();

        $findProduct = $this->getDoctrine()
            ->getRepository('AppBundle:Basket')
            ->findOneBy(array(
                "idSession" => $session_id,
                "products" => $id
            ));
        if ($findProduct == null) {
            $product = $this->getDoctrine()
                ->getRepository('AppBundle:Products')
                ->findOneById($id);

            $basket = new Basket();
            $basket->setProducts($product);
            $basket->setIdSession($session_id);
            $basket->setCount(1);


            $add->persist($basket);
            $add->flush();
        } else {
            $findProduct->updateCount();
            $add->flush();

        }


        $response = new RedirectResponse('/menu');
        $response->send();
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @Route("/delete{id}", name="delete_basket")
     */
    public function deleteAction(Request $request, $id)
    {
        $session = $request->getSession();
        $session_id = $session->getId();

        $em = $this->getDoctrine()->getManager();
        $basket = $em->getRepository('AppBundle:Basket')->findOneBy(array(
            'products' => $id,
            'idSession' => $session_id
        ));
        if ($basket->getCount() == 1) {
            $em->remove($basket);
            $em->flush();
        } else {
            $basket->minusCount();
            $em->flush();
        }

        return $this->redirectToRoute('basket');


    }

}