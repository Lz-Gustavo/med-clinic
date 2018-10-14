<?php

	require_once "../../class/storage.php";

	$db_instance = Storage::getInstance();
	$db_instance->connect("GeracaoSaude");
    
	$array_data = array(
        "TABLE:" => "pacientes",
		"CPF:" => $_POST['cpf'],
		"NOME:" => $_POST['name'],
		"SOBRENOME:" => $_POST['last_name'],
		"NASCIMENTO:" => $_POST['bday'],
		"SANGUE:" => $_POST['blood'],
		"EMAIL:" => $_POST['email'],
		"TELEFONE:" => $_POST['tel'],
	);
    
	$db_instance->write($array_data);
	$db_instance->disconnect();

	header("location: ../../../front_view/admin_panel/patients_template.php");
?>