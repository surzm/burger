<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Positions;
use AppBundle\Form\OrderForm;
use AppBundle\Entity\Orders;
use AppBundle\Entity\Basket;
use AppBundle\Entity\Products;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
    /**
     * @Route("/admin", name = "admin")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $orders =$em->getRepository('AppBundle:Orders')
                    ->findAll();

        return $this->render('/admin/index.html.twig', array(
            'orders' => $orders,
//            'dump' => var_dump($orders)
        ));

    }

    /**
     * @param $id
     * @return Response
     * @Route("admin/{id}", name="order_admin")
     */
    public function orderAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT p.name , b.count FROM AppBundle\Entity\Products p JOIN AppBundle\Entity\Positions b WITH p.id = b.idProduct
             WHERE b.idOrder = :id'
        );
        $query->setParameter('id', $id);
        $order = $query->getResult();

        return $this->render('admin/order.html.twig', array(
            'orders' => $order,
        ));
    }
}