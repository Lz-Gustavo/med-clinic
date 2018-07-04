<?php

	require_once "../php_backend/class/storage.php";

	if ((isset($_POST['doctor_login_user'])) || (isset($_POST['admin_login_user']))) {

		$hd = Storage::getInstance();
		$permission = $hd->login("medico", $_POST['login_user'], $_POST['login_psw']);
	
		if ($permission == 1) {
			if (isset($_POST['doctor_login_user'])) {
				echo "href pra pagina doctor<br>";
			}
			else if (isset($_POST['admin_login_user'])) {
				echo "href pra pagina secretary<br>";
			}
		}
		else {
			echo "senha incorreta<br>";
		}
	}
?>