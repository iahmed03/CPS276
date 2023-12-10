<?php

require_once "classes/Pdo_methods.php";

$elementsArr = [
    "error"=>"<p><span style='color: red; margin-left: 15px;'>Wrong credentials. Try Again</span></p>",
    "email"=>"iahmed3@test.com",
    "password"=>"password"
];

function init_login(){
    global $elementsArr;
    sessionCheck();
    if (isset($_POST['submit'])){
        $check=checkCredentials();
        if ($check == "error"){
            return getLoginForm($elementsArr['error']);
        }
        else{
            $_SESSION['login']="success";
            $_SESSION['name']=$check['name'];
            $_SESSION['status']=$check['status'];
            header("Location: index.php");
        }
    }
    return getLoginForm();
}

function getLoginForm($error=null){
    global $elementsArr;
    $form = <<<HTML
    <form method="post" action="">
    <div class="form-group">
        {$error}
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" value='{$elementsArr["email"]}'>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" value='{$elementsArr["password"]}'>
    <div class="form-group">
      <input type="submit" class="btn btn-primary" name="submit" value="Login" >
    </div>
    HTML;

    return $form;
}


function checkCredentials(){
    $pdo = new PdoMethods();
    $sql = "SELECT * FROM Admins";
    $records = $pdo->selectNotBinded($sql); // Not checking if records are 0, because login needs to match email id and if no records, it will forever give error.
    foreach($records as $row){
        if ($_POST['email'] === $row['email']){
            if (password_verify($_POST['password'], $row['password'])){
                return ["name"=>$row['name'], "status"=>$row['status']];
            }
        }
    }
    return "error";
  
}

function sessionCheck(){
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    else
    {
        session_destroy();
        session_start(); 
    }
}

?>