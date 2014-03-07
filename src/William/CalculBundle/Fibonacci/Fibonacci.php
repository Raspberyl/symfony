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
            $sum = $this->calculfibonacci($nb-1) + $this->calculfibonacci($nb-2); 
            return $sum; 
        } 

    }
}