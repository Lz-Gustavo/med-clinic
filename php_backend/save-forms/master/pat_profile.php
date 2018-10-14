<?php
	require_once "../../class/storage.php";

	session_start();

	$db_instance = Storage::getInstance();
	$db_instance->connect("GeracaoSaude");

	$sql = "UPDATE GeracaoSaude.pacientes SET ";

	if (isset($_POST['last_name'])) {

		$sql .= "sobrenome='".$_POST['last_name']."', ";
	}
	if (isset($_POST['email'])) {

		$sql .= "email='".$_POST['email']."', ";
	}
	if (isset($_POST['tel'])) {

		$sql .= "telefone='".$_POST['tel']."', ";
	}
	if (isset($_POST['blood'])) {

		$sql .= "sangue='".$_POST['blood']."', ";
	}
	if (isset($_POST['bday'])) {

		$sql .= "nascimento='".$_POST['bday']."', ";
	}

	$sql = rtrim($sql, ", ");
	$sql .= " WHERE cpf='".$_SESSION['login_cpf']."';";

	$db_instance->SQLinsert($sql);
	$db_instance->disconnect();

	header("location: ../../../master-clinic/master-dashboard/patient_master/patient_profile.php");
?>
