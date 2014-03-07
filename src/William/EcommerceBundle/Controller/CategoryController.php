<?php

namespace William\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use William\EcommerceBundle\Entity\Category;

class categoryController extends Controller
{
    public function indexAction($id)
    {
        return $this -> render('WilliamEcommerceBundle:Default:index.html.twig', array('id' => $id));
    }

    public function addAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $category = new Category();
        $category->settitle("SPORT");

        $em->persist($category);
        $em->flush();

        return new Response("Ajout effectué");
    }

    public function deleteAction($id)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $repository = $em->getRepository('WilliamEcommerceBundle:category');
        $category = $repository->find($id);
        $em->remove($category);

        $em->flush();

        return new Response("Suppression du produit n° ".$id." effectué.");
    }

    public function editAction($id)
    {
        return $this -> render('WilliamEcommerceBundle:Default:edit.html.twig', array('id' => $id));
    }

    public function categoryAction($id, $_format)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $repository = $em->getRepository('WilliamEcommerceBundle:category');
        $category = $repository->find($id);

    	switch ($_format) {
    		case 'html':
    			$answer = $this -> render('WilliamEcommerceBundle:Default:category.html.twig', array('id' => $id, 'category' => $category));
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