<?php


$pageData = [];
$pageData['nav']="";

$base = "https://russet-v8.wccnet.edu/~iahmed3/cps276/Assignments/Assignment-10-1/index.php?page=";

$navAdmin = <<<NAV
<nav style="background: #eee; height: 30px; border-radius: 5px; margin-bottom: 15px;">
  <ul style="list-style: none">
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}addContact">Add Contact</a></li>
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}deleteContacts">Delete Contact(s)</a></li>
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}addAdmin">Add Admin</a></li>
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}deleteAdmins">Delete Admin(s)</a></li>
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}logout">Logout</a></li>
  </ul>
</nav>
NAV;

$navStaff = <<<NAV
<nav style="background: #eee; height: 30px; border-radius: 5px; margin-bottom: 15px;">
  <ul style="list-style: none">
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}addContact">Add Contact</a></li>
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}deleteContacts">Delete Contacts</a></li>
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}logout">Logout</a></li>
  </ul>
</nav>
NAV;

// CHECKS IF SESSION ALREADY STARTED AND IF STARTED, ASSIGNS THE NAVIGATIONS ACCORDING TO STATUS
session_start();
if(isset($_SESSION['login'])){
	if ($_SESSION['status']=="Admin"){
		$pageData['nav']=$navAdmin;
	}
	else{
		$pageData['nav']=$navStaff;
	}
}

// LOGIC THAT GUIDES EACH REQUEST TO ITS PAGE
	if (isset($_GET)){
		if (isset($_SESSION['login'])|| $_GET['page']=='login'){
			switch($_GET['page']){
				case "welcome" :
					require_once 'welcome.php';
					$pageData['title'] = "Welcome";
					$pageData['heading'] = "Welcome";
					$pageData['content'] = init_welcome($_SESSION['name']);
					break; 
				case "addContact" : 
					require_once 'addContact.php'; 
					$pageData['title'] = "Add Contact";
					$pageData['heading'] = "Add Contact";
					$pageData['content'] = init_addContact(); 
					break;
				case "deleteContacts" : 
					require_once 'deleteContacts.php'; 
					$pageData['title'] = "Delete Contacts";
					$pageData['heading'] = "Delete Contacts";
					$pageData['content'] = initDeleteContacts(); 
					break;
				case "addAdmin" :
					checkSessionstatus();
					require_once 'addAdmin.php'; 
					$pageData['title'] = "Add Admin";
					$pageData['heading'] = "Add Admin";
					$pageData['content'] = init_addAdmin(); 
					break;
				case "deleteAdmins" :
					checkSessionstatus();
					require_once 'deleteAdmins.php';
					$pageData['title'] = "Delete Admins";
					$pageData['heading'] = "Delete Admins";
					$pageData['content'] = initDeleteAdmins(); 
					break;
				case "logout" : 
					require_once 'logout.php';
					$pageData['nav']="";
					$pageData['title'] = "Logout";
					$pageData['heading'] = "Logout";
					$pageData['content'] = init_logout($base); 
					 break;
				case "login" : 
					require_once 'login.php';
					$pageData['nav']="";
					$pageData['title'] = "Login";
					$pageData['heading'] = "Login";
					$pageData['content'] = init_login(); 
					break;
				default :
				    header("Location: {$base}login");
			}
		}
		else {
			header("Location: {$base}login");
		}

	}
	else {
		header("Location: {$base}login");
	}

	
// FUNCTION THAT TERMINATES SESSION AND RETURNS THE USER TO LOGIN PAGE IF USER NOT ADMIN AND ACESSING ADMIN ONLY PAGES.
function checkSessionstatus(){
	global $base;
	if ($_SESSION['status']=="Staff"){
		session_destroy();
				setcookie(session_name(), "", time() - 3600, "/");
				header("Location: {$base}");
	}
}

	
