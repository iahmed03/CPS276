<?php

require_once 'AddName.php';
$addName=new AddName();

if (isset($_POST["addName"])){
    $addName->add_name($_POST["name"]);
    echo "in add name{$_POST["name"]}";
    echo $addName->display_name_list();
}

else if(isset($_POST["clearName"])){
    $addName->clear_names();
    echo "in clear name";
}

header('Location: Names.php');

?>