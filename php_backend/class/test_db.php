<?php
	require_once "secretary.php";
	require_once "storage.php";

	$admin = new Secretary("administrator", "ronaldinho10");
	$result = $admin->show_all_doctors();

	var_dump($result);
?>