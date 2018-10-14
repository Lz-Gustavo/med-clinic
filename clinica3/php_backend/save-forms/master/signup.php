<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require_once "../../class/storage.php";

	$db_instance = Storage::getInstance();
	$db_instance->connect("GeracaoSaude");
	
	if ($_POST['inlineRadioOptions'] == "patient") {
		
		$cred_data = array(
			"TABLE:" => "credentials",
			"CPF:" => $_POST['cpf'],
			"PW:" => hash("md5", $_POST['password'])
		);

		$array_data = array(
			"TABLE:" => "pacientes",
			"CPF:" => $_POST['cpf'],
			"NOME:" => $_POST['username'],
			"SANGUE:" => "O+"
		);
	}
	else if ($_POST['inlineRadioOptions'] == "medic") {
		
		$cred_data = array(
			"TABLE:" => "credentials",
			"CRM:" => $_POST['crm'],
			"PW:" => hash("md5", $_POST['password'])
		);

		$array_data = array(
			"TABLE:" => "medicos",
			"CRM:" => $_POST['crm'],
			"NOME:" => $_POST['username']
		);
	}

	$db_instance->write($array_data);
	$db_instance->write($cred_data);
	$db_instance->disconnect();

	header("location: ../../../master-clinic/index.html");
?>