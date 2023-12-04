<?php
require_once '../classes/Crud.php';
require_once '../classes/Page.php';

function login(){

	$pageData['title'] = "Login";
	$pageData['heading'] = "Login";
	$pageData['content'] = require_once '../pages/login.php';
	$pageData['js'] = "<script src='public/js/main.js'></script>";
	return $pageData;
}

function logout(){

	$pageData['title'] = "Logout";
	$pageData['heading'] = "Logout";
	$pageData['content'] = require_once '../pages/logout.php';
	$pageData['js'] = "<script src='public/js/main.js'></script>";
	return $pageData;
}

function home(){
	$page = new Page();
	$pageData['title'] = "Home Page";
	$pageData['heading'] = "Home Page";
	$pageData['nav'] = $page->nav();
	$pageData['content'] = require_once '../pages/home.php';
	$pageData['js'] = "";
	return $pageData;
}

function addContact(){
    require_once '../pages/addContact.php';
	//$nameList = getNames('list');
	$page = new Page();

	$pageData['title'] = "Add Contact";
	$pageData['heading'] = "Add Contact";
	$pageData['nav'] = $page->nav();
	$pageData['content'] = init();
	$pageData['js'] = "";
	return $pageData;
}

function addAdmin(){
	$page = new Page();

	$pageData['title'] = "Add Admin";
	$pageData['heading'] = "Add Admin";
	$pageData['nav'] = $page->nav();
	$pageData['content'] = require_once '../pages/addAdmin.php';
	$pageData['js'] = "";
	return $pageData;
}

function deleteAdmins(){
	$page = new Page();

	$pageData['title'] = "Delete Admin";
	$pageData['heading'] = "Delete Admin";
	$pageData['nav'] = $page->nav();
	$pageData['content'] = require_once '../pages/deleteAdmins.php';
	$pageData['js'] = "<script src='public/js/main.js'></script>";
	return $pageData;
}

function deleteContacts(){
    require_once '../pages/deleteContacts.php';
	$page = new Page();

	$pageData['title'] = "Deletee Contacts";
	$pageData['heading'] = "Delete Contacts";
	$pageData['nav'] = $page->nav();
	$pageData['content'] = init();
	$pageData['js'] = "";
	return $pageData;
}

?>