<?php
namespace William\CalculBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
class CalculController extends Controller
{
    public function calculAction($a,$b)
    {
    	$request = $this->getRequest();
    	$operation = $request->query->get('operation'); 

    	switch ($operation) {
    		case 'add':
    			$resultat = $a + $b;
    			break;
    		case 'sous':
    			$resultat = $a - $b;
    			break;    		
    		case 'mult':
    			$resultat = $a * $b;
    			break;
    		case 'div':
    			$resultat = $a / $b;
    			break;
    		default:
    			return new Response("Veuillez selectionner une operation.");
    			break;
    	}
    	
        return $this->redirect($this->generateUrl('william_calcul_resultat', array('resultat' => $resultat)));
    }

    public function resultatAction($resultat)
    {
    	return new Response("Le resultat est : ".$resultat);
    }

    public function fiboAction($nb)
    {
        $fibo = $this->get('william_calcul.fibonacci');
        $resultat = $fibo->calculfibonacci($nb);
        return $this->redirect($this->generateUrl('william_calcul_resultat', array('resultat' => $resultat)));
    }
}