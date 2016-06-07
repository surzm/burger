<?php



namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AccountController extends Controller
{
    /**
     * @Route("/account/{id}", name="account")
     */
    public function indexAction($id)
    {

        $orders = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findOneById($id)
            ->getOrders();

        return $this->render('account/index.html.twig', array(
            'orders' => $orders
        ));


    }

    /**
     * @param $id
     * @return Response
     * @Route("/details/{id}", name="details")
     */
    public function detailsAction($id)
    {
        $order = $this->getDoctrine()
            ->getRepository('AppBundle:Orders')
            ->findOneById($id);


        $position = $order->getPosition();


        return $this->render('account/details.html.twig', array(
            'orders' => $position,
            'id'=>$id
        ));

    }
}