<?php

require_once "classes/Pdo_methods.php";
require_once('classes/StickyForm.php');
    $stickyForm = new StickyForm();


$elementsArr = [
    "masterStatus"=>[
        "status"=>"noerrors",
        "type"=>"masterStatus"
      ],
    "error"=>["value"=>"<p><span style='color: red; margin-left: 15px;'>Login credentials incorrect</span></p>", "type"=>""],
    "email"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>cannot be blank, and must be written as proper email</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"iahmed3@admin.com",
        "regex"=>"email"
      ],
    "password"=>["value"=>"password", "type"=>""]
];

function init_login(){
    global $elementsArr;
    global $stickyForm;
    if(isset($_SESSION)) { 
        session_destroy();
        setcookie(session_name(), "", time() - 3600, "/");
    }
    if (isset($_POST['submit'])){
        $postArr = $stickyForm->validateForm($_POST, $elementsArr);
        $elementsArr=$postArr;
        if($elementsArr['masterStatus']['status'] == "noerrors"){
            $check=checkCredentials();
            if ($check == "error"){
                return getLoginForm($elementsArr['error']['value']);
            }
            else {
                session_start();
                $_SESSION['login']="success";
                $_SESSION['name']=$check['name'];
                $_SESSION['status']=$check['status'];
                header("Location: index.php?page=welcome");
        }
        }
        else {
            getLoginForm("",$elementsArr);
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
        <label for="email">Email {$elementsArr['email']['errorOutput']}</label>
        <input type="text" class="form-control" name="email" value='{$elementsArr["email"]["value"]}'>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" value='{$elementsArr["password"]["value"]}'>
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

}

?>