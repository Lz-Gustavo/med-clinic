<?php

	require_once "../../class/storage.php";

	session_start();

	$db_instance = Storage::getInstance();

	$db_instance->connect("GeracaoSaude");

	if (isset($_GET['clinic'])) {

		$sql = "SELECT medicos.especializacao ";
		$sql .= "FROM GeracaoSaude.medicos RIGHT JOIN GeracaoSaude.func_clinica ON medicos.crm=func_clinica.crm WHERE clinica='".$_GET['clinic']."'";
	
	}
	else {

		$sql = "SELECT medicos.especializacao ";
		$sql .= "FROM GeracaoSaude.medicos RIGHT JOIN GeracaoSaude.func_clinica ON medicos.crm=func_clinica.crm";

	}

	$sql .= ";";
	$result = $db_instance->SQLretrieve($sql);

	for ($i = 0; $i < count($result); $i++) {

		echo "<option value='". $result[$i]["especializacao"] . "'>". $result[$i]["especializacao"] ."</option>";
	}

	$db_instance->disconnect();
?> 