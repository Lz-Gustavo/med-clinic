<?php

	require_once "../../class/storage.php";

	$db_instance = Storage::getInstance();

	$db_instance->connect("GeracaoSaude");

	$result = $db_instance->read_all("pacientes");

	for ($i = 0; $i < count($result); $i++) {

		echo "<option value='". $result[$i]["cpf"] . "'>". $result[$i]["cpf"]." - ".$result[$i]["nome"] ."</option>";
	}

	$db_instance->disconnect();
?> 