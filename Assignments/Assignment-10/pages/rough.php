<?php

require_once '../classes/Crud.php';

$var= new Crud();


print_r($var->getTableData("Contacts"));
?>