<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_establishment"){
	$save = $crud->save_establishment();
	if($save)
		echo $save;
}
if($action == "delete_establishment"){
	$save = $crud->delete_establishment();
	if($save)
		echo $save;
}

if($action == "delete_records"){
	$save = $crud->delete_records();
	if($save)
		echo $save;
}

if($action == "save_household"){
	$save = $crud->save_household();
	if($save)
		echo $save;
}

if($action == "save_reliefpacks"){
	$save = $crud->save_reliefpacks();
	if($save)
		echo $save;
}

if($action == "save_distribute"){
	$save = $crud->save_distribute();
	if($save)
		echo $save;
}

if($action == "delete_household"){
	$save = $crud->delete_household();
	if($save)
		echo $save;
}
if($action == "distribute_done"){
	$save = $crud->distribute_done();
	if($save)
		echo $save;
}

if($action == "save_track"){
	$save = $crud->save_track();
	if($save)
		echo $save;
}
if($action == "delete_track"){
	$save = $crud->delete_track();
	if($save)
		echo $save;
}
if($action == "get_pdetails"){
	$get = $crud->get_pdetails();
	if($get)
		echo $get;
}