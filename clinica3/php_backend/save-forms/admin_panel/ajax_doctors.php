<?php

	require_once "../../class/storage.php";

	session_start();

	$db_instance = Storage::getInstance();

	$db_instance->connect("GeracaoSaude");

	//$result = $db_instance->read_all("medicos");

	$sql = "SELECT medicos.crm, medicos.nome ";
	$sql .= "FROM GeracaoSaude.medicos RIGHT JOIN GeracaoSaude.func_clinica ON medicos.crm=func_clinica.crm WHERE clinica='".$_SESSION['clinic']."'";

	$result = $db_instance->SQLretrieve($sql);

	for ($i = 0; $i < count($result); $i++) {

		echo "<option value='". $result[$i]["crm"] . "'>". $result[$i]["crm"]." - ".$result[$i]["nome"] ."</option>";
	}

	$db_instance->disconnect();
?> 