<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

	require_once "../../class/storage.php";

    session_start();

    $db_instance = Storage::getInstance();
	$db_instance->connect("GeracaoSaude");

	$array_data = array(
		"TABLE:" => "consultas",
		"crm:" => $_POST['crm'],
		"cpf:" => $_SESSION['login_cpf'],
        "clinica:" => $_POST['clinic'],
        "dia:" => $_POST['appt_date'],
        "horario:" => $_POST['time']
	);	
	
	$db_instance->appointment($array_data);
	$db_instance->disconnect();

    header("location: ../../../master-clinic/master-dashboard/patient_master/patient_profile.php");
?>