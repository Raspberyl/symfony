<?php
namespace William\CalculBundle\Fibonacci;
class Fibonacci
{
    public function calculfibonacci($nb)
    {
        if($nb<=2)
        { 
            return 1; 
        } 

        else
        { 
            $sum = calculfibonacci($nb-1) + calculfibonacci($nb-2); 
            return $sum; 
        } 

    }
}