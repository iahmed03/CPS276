<?php

require_once '../classes/Validations.php';

$var= new Validation();


print_r($var->checkFormat("2023sdf134@gmail.com", "email"));
?>