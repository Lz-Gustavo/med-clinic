<?php
	require_once "../php_backend/class/storage.php";

	if (isset($_POST['login_user'])) {

		$hd = Storage::getInstance();
		
		if ($_POST['login_user'] == "admin") {
			
			$permission = $hd->login("atendente", $_POST['login_user'], $_POST['login_password']);

			if ($permission == 1) {

				session_start();
				$_SESSION['login_user'] = $_POST['login_user'];
				echo "0";
			}
			else {
				echo "-1";
			}
		}
		else {
			$permission = $hd->login("medico", $_POST['login_user'], $_POST['login_password']);

			if ($permission == 1) {

				session_start();
				$_SESSION['login_user'] = $_POST['login_user'];
				echo "1";
			}
			else {
				echo "-1";
			}
		}
	}	
?>