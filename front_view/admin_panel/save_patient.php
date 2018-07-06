<?php

	require_once "../../php_backend/class/storage.php";
	require_once "../../php_backend/class/person.php";
	require_once "../../php_backend/class/secretary.php";

	$secretary = new Secretary("admin", "istrator", "1");   

    $secretary->add_changes("Nome:", $_POST['name']);
    $secretary->add_changes("Sobrenome:", $_POST['last_name']);
	$secretary->add_changes("Data:", $_POST['bday']);
	$secretary->add_changes("Sangue:", $_POST['blood']);
	$secretary->add_changes("CPF:", $_POST['cpf']);
	$secretary->add_changes("Email:", $_POST['email']);
    $secretary->add_changes("Telefone:", $_POST['tel']);
    $secretary->commit_changes("paciente");

	header("location: patients_template.php");
?>