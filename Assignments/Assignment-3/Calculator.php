<?php

 class Calculator{

    // Declaration and intialization of variables
    private $operator="";
    private $num1=0;
    private $num2=0;
    private $result="";

    public function calc($operator="error", $num1="error", $num2="error"){
        global $result;

        // logic to calculate the numbers based on the appropriate arthimetic operator.
        if ($operator!=="error" && $num1!=="error" && $num2!=="error"){
            if ($num2!==0){
                switch($operator){
                    case "+":
                        $result="The sum of the two numbers is ".$num1+$num2."<br />";
                        break;
                    case "-":
                        $result="The difference of the two numbers is ".$num1-$num2."<br />";
                        break;
                    case "/":
                        $result="The division of the two numbers is ".$num1/$num2."<br />";
                        break;
                    case "*":
                        $result="The product of the two numbers is ".$num1+$num2."<br />";
                        break;    
                }
            }
            else {
                $result="Cannot divide by zero <br />";
            }
        }  
        else {
            $result="You must enter a string and two numbers <br />";
        }

        return $result;
    }
}


?>