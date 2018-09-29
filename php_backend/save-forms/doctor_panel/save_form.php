<?php

	require_once "../../class/storage.php";

	session_start();

	$db_instance = Storage::getInstance();
	$db_instance->connect("GeracaoSaude");

	$sql = "UPDATE GeracaoSaude.medicos SET ";
	
	if (isset($_POST['last_name'])) {

		$sql .= "sobrenome='".$_POST['last_name']."', ";
	}
	if (isset($_POST['spec'])) {

		$sql .= "especializacao='".$_POST['spec']."', ";
	}
	if (isset($_POST['email'])) {

		$sql .= "email='".$_POST['email']."', ";
	}
	if (isset($_POST['tel'])) {

		$sql .= "telefone='".$_POST['tel']."', ";
	}
	if (isset($_POST['addr'])) {

		$sql .= "endereco='".$_POST['addr']."', ";
	}

	$sql = rtrim($sql, ", ");
	$sql .= " WHERE crm='".$_SESSION['login_crm']."';";

	//$file = fopen("test.txt", "w");
    	//fwrite($file, $sql);
   	//fclose($file);
	
	$db_instance->SQLinsert($sql);
	$db_instance->disconnect();

	header("location: ../../../front_view/doctor_panel/profile_template.php");
?>