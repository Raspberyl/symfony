<?php

namespace William\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use William\EcommerceBundle\Entity\Product;

class IndexController extends Controller
{
    public function indexAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $repository = $em->getRepository('WilliamEcommerceBundle:Product');
        $list = $repository->findBy(
            array('stock' => '1'),
            array('creationdate' => 'DESC'),
            '20'           
        );

        return $this -> render('WilliamEcommerceBundle:Default:index.html.twig', array('list' => $list));
    }   

    public function indexByBrandAction($id)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $repository = $em->getRepository('WilliamEcommerceBundle:Product');
        $list = $repository->findBy(
            array('stock' => '1' , 'brand' => $id),
            array('creationdate' => 'DESC'),
            '20'           
        );

        return $this -> render('WilliamEcommerceBundle:Default:index.html.twig', array('list' => $list));
    }
}
