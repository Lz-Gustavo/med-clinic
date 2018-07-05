<?php

	//action do form de profile_template.php
	//vou ter q modificar o modify de storage...
	require_once "../../php_backend/class/storage.php";
	require_once "../../php_backend/class/person.php";
	require_once "../../php_backend/class/doctor.php";

	$doctor = new Doctor("admin", "istrator", "1");

	$doctor->add_changes("Nome:", $_POST['name']);
	$doctor->add_changes("Sobrenome:", $_POST['last_name']);
	$doctor->add_changes("Email:", $_POST['email']);
	$doctor->add_changes("Telefone:", $_POST['tel']);
	$doctor->add_changes("CRM:", $_POST['crm']);
	$doctor->commit_changes();

	//falha de seguranca, porem necessario ja que eh permitido a ele alterar o nome/login assim
	session_start();
	$_SESSION['login_user'] = $_POST['name'];

	header("location: profile_template.php");
?>