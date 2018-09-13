<?php
	//ini_set('display_errors', 1);
	//ini_set('display_startup_errors', 1);
	//error_reporting(E_ALL);

    require_once "../../class/storage.php";
    
	$db_instance = Storage::getInstance();
	$db_instance->connect("GeracaoSaude");
    
	$array_data = array(
        "TABLE:" => "medicos",
		"CRM:" => $_POST['crm'],
		"NOME:" => $_POST['name'],
		"SOBRENOME:" => $_POST['last_name'],
		"ESPECIALIZACAO:" => $_POST['spec'],
		"EMAIL:" => $_POST['email'],
		"TELEFONE:" => $_POST['tel'],
		"ENDERECO:" => $_POST['addr'],
	);
    
	$db_instance->write($array_data);
	$db_instance->disconnect();
    
    header("location: ../../../front_view/admin_panel/medics_template.php");
?>