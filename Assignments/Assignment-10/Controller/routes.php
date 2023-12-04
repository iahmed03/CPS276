<?php
if (isset($_GET['file'])){
	$page = $_GET['file'];
}

else {
	$page = "home";
}
	
switch($page){
	case "home" : require_once 'controller.php'; $pageData = home(); break;
	case "addContact" : require_once 'controller.php'; $pageData = addContact(); break;
	case "deleteContacts" : require_once 'controller.php'; $pageData = deleteContacts(); break;
	case "addAdmin" : require_once 'controller.php'; $pageData = addAdmin(); break;
    case "deleteAdmins" : require_once 'controller.php'; $pageData = deleteAdmins(); break;
	case "login" : require_once 'controller.php'; $pageData = login(); break;
	case "logout" : require_once 'controller.php'; $pageData = logout(); break;
	default : require_once 'controller.php'; $pageData = home(); break;
}