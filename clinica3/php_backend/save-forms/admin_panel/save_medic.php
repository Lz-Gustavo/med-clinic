<?php
	//ini_set('display_errors', 1);
	//ini_set('display_startup_errors', 1);
	//error_reporting(E_ALL);

    require_once "../../class/storage.php";
    
	session_start();

	$db_instance = Storage::getInstance();
	$db_instance->connect("GeracaoSaude");

	$medic_data = array(
        "TABLE:" => "medicos",
		"CRM:" => $_POST['crm'],
		"NOME:" => $_POST['name'],
		"SOBRENOME:" => $_POST['last_name'],
		"ESPECIALIZACAO:" => $_POST['spec'],
		"EMAIL:" => $_POST['email'],
		"TELEFONE:" => $_POST['tel'],
		"ENDERECO:" => $_POST['addr'],
	);

	$func_data = array(
		"TABLE:" => "func_clinica",
		"CRM:" => $_POST['crm'],
		"CLINICA:" => $_SESSION['clinic'],
		"SEG:" => "00000000",
		"TER:" => "00000000",
		"QUA:" => "00000000",
		"QUI:" => "00000000",
		"SEX:" => "00000000",
	);
    
	$db_instance->write($medic_data);
	$db_instance->write($func_data);

	$db_instance->disconnect();
    
    header("location: ../../../front_view/admin_panel/medics_template.php");
?>