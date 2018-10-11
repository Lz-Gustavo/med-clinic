<?php

	require_once "../../class/storage.php";

	session_start();

	$db_instance = Storage::getInstance();

	$db_instance->connect("GeracaoSaude");

	if (isset($_GET['clinic'])) {

		$sql = "SELECT medicos.crm, medicos.nome ";
		$sql .= "FROM GeracaoSaude.medicos RIGHT JOIN GeracaoSaude.func_clinica ON medicos.crm=func_clinica.crm WHERE clinica='".$_GET['clinic']."'";
	
		if (isset($_GET['spec']))
			$sql .= " AND medicos.especializacao='".$_GET['spec']."'";
	}
	else {

		$sql = "SELECT medicos.crm, medicos.nome ";
		$sql .= "FROM GeracaoSaude.medicos RIGHT JOIN GeracaoSaude.func_clinica ON medicos.crm=func_clinica.crm";

		if (isset($_GET['spec']))
			$sql .= " WHERE medicos.especializacao='".$_GET['spec']."'";
	}

	$sql .= ";";
	$result = $db_instance->SQLretrieve($sql);

	for ($i = 0; $i < count($result); $i++) {

		echo "<option value='". $result[$i]["crm"] . "'>". $result[$i]["crm"]." - ".$result[$i]["nome"] ."</option>";
	}

	$db_instance->disconnect();
?> 