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
use Symfony\Component\HttpFoundation\Session\Session;

class OrderController extends Controller
{
    /**
     * @Route("/order", name = "order")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $session_id = $session->getId();
        $order = new Orders();
        $form = $this->createForm(OrderForm::class, $order, array(
            'action' => $this->generateUrl('order')
        ));

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $order = $form->getData();
            $order->setDatetime(new \DateTime('now'));
            $order->setTotalCost($session->get('total'));
            $em->persist($order);
            $em->flush();

            $basket = $em->getRepository('AppBundle:Basket')->findByIdSession($session_id);

            foreach($basket as $string){
                $position = $string->createPosition();
                $position->setIdOrder($order->getId());
                $em->persist($position);
                $em->remove($string);
                $em->flush();
            }

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Спасибо! Ваш заказ принят и оформляется.')
            ;

            return $this->redirectToRoute('main');
        }
        return $this->render('order/index.html.twig', array(
            'form' => $form->createView(),
        ));


    }

}
