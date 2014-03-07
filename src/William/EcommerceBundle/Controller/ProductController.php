<?php

namespace William\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use William\EcommerceBundle\Entity\Product;
use William\EcommerceBundle\Entity\Brand;
use William\EcommerceBundle\Entity\Category;

class ProductController extends Controller
{
    public function addAction()
    {
        $formFactoryBuilder = Form::createFormFactoryBuilder();
        $formFactory = $formFactoryBuilder->getFormFactory();

        $product = new Product();

        $form = $this->createFormBuilder($product)
                    ->add('title', 'text')
                    ->add('description', 'textarea')
                    ->add('creationdate', 'datetime')
                    ->add('save', 'submit')
                    ->getForm();

        return $this->render('WilliamEcommerceBundle:Blog:addArticle.html.twig',
        array('formulaire' => $form->createView()));


    }

    public function deleteAction($id)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $repository = $em->getRepository('WilliamEcommerceBundle:Product');
        $product = $repository->find($id);
        $em->remove($product);

        $em->flush();

        return new Response("Suppression du produit n° ".$id." effectué.");
    }

    public function editAction($id)
    {
        return $this -> render('WilliamEcommerceBundle:Default:edit.html.twig', array('id' => $id));
    }

    public function productAction($id, $_format)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $repository = $em->getRepository('WilliamEcommerceBundle:Product');
        $product = $repository->find($id);

    	switch ($_format) {
    		case 'html':
    			$answer = $this -> render('WilliamEcommerceBundle:Default:product.html.twig', array('product' => $product));
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
