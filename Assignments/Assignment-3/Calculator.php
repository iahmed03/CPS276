<?php

 class Calculator{

    // Declaration and intialization of variables (not used in the logic but created for better understanding. To populate the data if constructor with parameters is created; changing how this code is used for calculation)
    private $operator="";
    private $num1=0;
    private $num2=0;

    public function calc($operator="error", $num1="error", $num2="error"){
        $result="";
        
        // logic to calculate the numbers based on the appropriate arthimetic operator. Outputting error messages if wrong data assigned.
        if ($operator!=="error" && $num1!=="error" && $num2!=="error"){
            if ($num2!==0){
                switch($operator){
                    case "+":
                        $result="The sum of the numbers is ".$num1+$num2."<br />";
                        break;
                    case "-":
                        $result="The difference of the numbers is ".$num1-$num2."<br />";
                        break;
                    case "/":
                        $result="The division of the numbers is ".$num1/$num2."<br />";
                        break;
                    case "*":
                        $result="The product of the numbers is ".$num1+$num2."<br />";
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