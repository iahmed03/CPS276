<?php

session_start();

$pageData = [];
$pageData['nav']="";

$base = "https://russet-v8.wccnet.edu/~iahmed3/cps276/Assignments/Assignment-10-1/index.php?page=";

$navAdmin = <<<NAV
<nav style="background: #eee; height: 30px; border-radius: 5px; margin-bottom: 15px;">
  <ul style="list-style: none">
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}addContact">Add Contact</a></li>
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}deleteContacts">Delete Contacts</a></li>
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}addAdmin">Add Admin</a></li>
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}deleteAdmins">Delete Admins</a></li>
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



if(isset($_SESSION['login'])){
	if ($_SESSION['status']=="Admin"){
		$pageData['nav']=$navAdmin;
	}
	else{
		$pageData['nav']=$navStaff;
	}
	if (isset($_GET['page'])){
		switch($_GET['page']){
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
				$pageData['content'] = init_logout($_SESSION['name']); 
				 break;
			default :
			    require_once 'login.php';
			    $pageData['title'] = "Login";
			    $pageData['heading'] = "Login";
			    $pageData['content'] = init_login(); 
		}
	}
	
	else {
		require_once 'welcome.php';
			$pageData['title'] = "Welcome";
			$pageData['heading'] = "Welcome";
			$pageData['content'] = init_welcome($_SESSION['name']); 
	}
}
else {
	require_once 'login.php';
			$pageData['title'] = "Login";
			$pageData['heading'] = "Login";
			$pageData['content'] = init_login(); 
}

function checkSessionstatus(){
	global $base;
	if ($_SESSION['status']=="Staff"){
		session_destroy();
				setcookie(session_name(), "", time() - 3600, "/");
				header("Location: {$base}");
	}
}

	
