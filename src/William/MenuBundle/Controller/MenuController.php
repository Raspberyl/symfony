<?php

namespace William\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function displayPrimaryMenuAction()
    {
    	$doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $repository = $em->getRepository('WilliamEcommerceBundle:Brand');
        $list = $repository->findAll();
        return $this->render('WilliamMenuBundle:Menu:primary_menu.html.twig', array('list' => $list));
    }
}
