<?php

	require_once "../../class/storage.php";

	if ((isset($_GET['day'])) && (isset($_GET['crm']))) {

		$week = array("dom", "seg", "ter", "qua", "qui", "sex", "sab");

		$dayofweek = date('w', strtotime($_GET['day']));

		if (($dayofweek == 0) || ($dayofweek == 6)) {
			return;
		}

		$db_instance = Storage::getInstance();
		$db_instance->connect("GeracaoSaude");

		// NOTE: since it's displayed on UI just the doctors from the same clinic, theres no need to filter for clinic id
		// on this query
		$sql = "SELECT func_clinica.".$week[$dayofweek]." FROM GeracaoSaude.func_clinica WHERE crm='".$_GET['crm']."';";
	
		$result = $db_instance->SQLretrieve($sql);

		$time = str_split($result[0][$week[$dayofweek]]);
		$mask = array("0", "0", "0", "0", "0", "0", "0", "0");

		for ($i = 0; $i < count($time); $i++) {

			if ($time[$i] == "0") {
				
				$mask[$i] = "1";
				$value = implode(" ", $mask);
				$hour = $db_instance->translate_time($value);
				
				//print equivalent option
				echo "<input type=\"radio\" name=\"time\" value=\"".$value."\">".$hour."<br>"; 

				//reset mask
				$mask = array("0", "0", "0", "0", "0", "0", "0", "0");
			}
		}

		$db_instance->disconnect();
	}
?> 