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
        $user = $this->getUser();

        if($user->getId()==$id) {
            return $this->render('account/index.html.twig', array(
                'orders' => $orders
            ));
        }else{
            return $this->render('errors/access.html.twig');
        }

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