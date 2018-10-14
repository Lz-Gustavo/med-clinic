<?php

	require_once "../../class/storage.php";

	session_start();

	$db_instance = Storage::getInstance();

	$db_instance->connect("GeracaoSaude");

	$result = $db_instance->read_all("clinicas");

	for ($i = 0; $i < count($result); $i++) {

		echo "<option value='". $result[$i]["id"] . "'>". $result[$i]["id"]." - ".$result[$i]["nome"] ."</option>";
	}

	$db_instance->disconnect();
?>
