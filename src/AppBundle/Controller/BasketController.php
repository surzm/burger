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

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT p , b.count FROM AppBundle\Entity\Products p JOIN AppBundle\Entity\Basket b WITH p.id = b.idProduct
             WHERE b.idSession = :id_session'
        );
        $query->setParameter('id_session', $session_id);
        $products = $query->getResult();
        function total($products)
        {
            $total=0;
            foreach ($products as $product) {
                $total += ($product[0]->getPrice() * $product['count']);
            };
            return $total;

        };
        $sum=total($products);
        $session->set('total',$sum);

            return $this->render('basket/index.html.twig', array(
                'products' => $products,
                'total' => $sum,
            ));

    }

    /**
     * @Route("/add{id}", name="add_basket")
     */
    public function addAction(Request $request, $id)
    {
        $session = $request->getSession();
        $session_id = $session->getId();
        $add = $this->getDoctrine()->getManager();

        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Basket')
            ->findOneBy(array(
                "idSession" => $session_id,
                "idProduct" => $id
            ));
        if ($product == null) {

            $basket = new Basket();
            $basket->setIdProduct($id);
            $basket->setIdSession($session_id);
            $basket->setCount(1);

            $add->persist($basket);
            $add->flush();
        } else {
            $product->updateCount();
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
            'idProduct' => $id,
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