<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Positions;
use AppBundle\Entity\Orders;
use AppBundle\Entity\Products;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections;



class AdminController extends Controller
{
    /**
     * @Route("/admin/main", name = "admin")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $orders =$em->getRepository('AppBundle:Orders')
                    ->findAll();

        return $this->render('/admin/index.html.twig', array(
            'orders' => $orders,
//
        ));

    }


    /**
     * @param $id
     * @return Response
     * @Route("/admin/{id}", name="order_admin")
     */
    public function orderAction($id)
    {
        $order = $this->getDoctrine()
            ->getRepository('AppBundle:Orders')
            ->findOneById($id);


        $position = $order->getPosition();


        return $this->render('admin/order.html.twig', array(
            'orders' => $position,
            'id'=>$id
        ));
    }

    //Меняет статус заказа
    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/admin/send/{id}", name = "send_order")
     */
    public function sendAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('AppBundle:Orders')->find($id);

        $order->setStatus(1);
        $em->flush();

        return $this->redirectToRoute('admin');
    }
}