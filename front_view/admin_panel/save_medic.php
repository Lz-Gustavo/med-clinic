<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

	require_once "../../php_backend/class/storage.php";
	require_once "../../php_backend/class/person.php";
	require_once "../../php_backend/class/secretary.php";

	$secretary = new Secretary("admin", "istrator", "1");   

    $secretary->add_changes("Nome:", $_POST['name']);
    $secretary->add_changes("Sobrenome:", $_POST['last_name']);
    $secretary->add_changes("Email:", $_POST['email']);
    $secretary->add_changes("Telefone:", $_POST['tel']);
    $secretary->add_changes("CRM:", $_POST['crm']);
    $secretary->commit_changes("medico");

	header("location: medics_template.php");
?>