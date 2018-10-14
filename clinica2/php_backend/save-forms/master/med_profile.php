<?php
	require_once "../../class/storage.php";

	session_start();

	$db_instance = Storage::getInstance();
	$db_instance->connect("GeracaoSaude");

	$sql = "UPDATE GeracaoSaude.medicos SET ";

	if (isset($_POST['last_name'])) {

		$sql .= "sobrenome='".$_POST['last_name']."', ";
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
	if (isset($_POST['spec'])) {

		$sql .= "especializacao='".$_POST['spec']."', ";
	}

	$sql = rtrim($sql, ", ");
	$sql .= " WHERE crm='".$_SESSION['login_crm']."';";

	$db_instance->SQLinsert($sql);
	$db_instance->disconnect();

	header("location: ../../../master-clinic/master-dashboard/doctor_master/doctor_profile.php");
?>