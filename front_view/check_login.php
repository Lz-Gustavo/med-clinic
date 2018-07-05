<?php
	require_once "../php_backend/class/storage.php";

	if (isset($_POST['login_user'])) {

		$hd = Storage::getInstance();
		
		//alterar depois que ta uma merda, tem q ter radio option no form
		if ($_POST['login_user'] == "admin") {
			
			$permission = $hd->login("atendente", $_POST['login_user'], $_POST['login_password']);

			if ($permission == 1) {

				session_start();
				$_SESSION['login_user'] = $_POST['login_user'];
				//echo "<pre>";
				//print_r($_SESSION);
				//echo "</pre>";
				header("location: admin_panel/admin_panel.html");
			}
			else {
				header("location: index.html");
			}
		}
		else {
			$permission = $hd->login("medico", $_POST['login_user'], $_POST['login_password']);

			if ($permission == 1) {

				session_start();
				$_SESSION['login_user'] = $_POST['login_user'];
				header("location: doctor_panel/doctor_panel.html");
			}
			else {
				header("location: index.html");
			}
		}
	}	
?>