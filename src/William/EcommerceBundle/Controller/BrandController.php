<?php

namespace William\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use William\EcommerceBundle\Entity\Brand;

class brandController extends Controller
{
    public function addAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $brand = new Brand();
        $brand->settitle("ADIDAS");
        $brand->setlogo("http://lorempixel.com/50/50/cats");

        $em->persist($brand);
        $em->flush();

        return new Response("Ajout effectué");
    }

    public function deleteAction($id)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $repository = $em->getRepository('WilliamEcommerceBundle:Brand');
        $brand = $repository->find($id);
        $em->remove($brand);

        $em->flush();

        return new Response("Suppression du produit n° ".$id." effectué.");
    }

    public function editAction($id)
    {
        return $this -> render('WilliamEcommerceBundle:Default:edit.html.twig', array('id' => $id));
    }

    public function brandAction($id, $_format)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $repository = $em->getRepository('WilliamEcommerceBundle:brand');
        $brand = $repository->find($id);

    	switch ($_format) {
    		case 'html':
    			$answer = $this -> render('WilliamEcommerceBundle:Default:brand.html.twig', array('id' => $id, 'brand' => $brand));
    			break;

   			case 'json':
    			$answer = new Response(json_encode(array("Produit n°".$id)));
    			break;
    		
    		default:
    			$answer = new Response("erreur =/");
    			break;
    	}

    	return $answer;
    } 
}
