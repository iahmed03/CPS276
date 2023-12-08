<?php

$pageData = [];

$base = "https://russet-v8.wccnet.edu/~iahmed3/cps276/Assignments/Assignment-10-1/index.php?page=";

$nav = <<<NAV
<nav style="background: #eee; height: 30px; border-radius: 5px; margin-bottom: 15px;">
  <ul style="list-style: none">
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}welcome">welcome</a></li>
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}addContact">Add Contact</a></li>
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}deleteContacts">Delete Contacts</a></li>
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}addAdmin">Add Admin</a></li>
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}deleteAdmins">Delete Admins</a></li>
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}login">Login</a></li>
	<li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$base}logout">Logout</a></li>
  </ul>
</nav>
NAV;

$pageData['nav']=$nav;

if (isset($_GET['page'])){
	switch($_GET['page']){
		case "welcome" : 
			require_once 'welcome.php';
			$pageData['title'] = "Welcomr";
	        $pageData['heading'] = "Welcome";
			$pageData['content'] = init_welcome(); 
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
			require_once 'addAdmin.php'; 
			$pageData['title'] = "Add Admin";
	        $pageData['heading'] = "Add Admin";
			$pageData['content'] = init_addAdmin(); 
			break;
		case "deleteAdmins" : 
			require_once 'deleteAdmins.php'; 
			$pageData['title'] = "Delete Admins";
	        $pageData['heading'] = "Delete Admins";
			$pageData['content'] = initDeleteAdmins(); 
			break;
		case "login" : 
			require_once 'login.php'; 
			$pageData['title'] = "Login";
	        $pageData['heading'] = "Login";
			$pageData['content'] = init_login(); 
			break;
		case "logout" : 
			require_once '../logout.php';
			$pageData['title'] = "Logout";
	        $pageData['heading'] = "Logout";
			$pageData['content'] = init_logout(); 
			 break;
		default :
		    require_once 'welcome.php';
			$pageData['title'] = "Welcomr";
	        $pageData['heading'] = "Welcome";
			$pageData['content'] = init_welcome(); 
			break;
	}
}

else {
	require_once 'welcome.php';
			$pageData['title'] = "Welcomr";
	        $pageData['heading'] = "Welcome";
			$pageData['content'] = init_welcome(); 
}
	
