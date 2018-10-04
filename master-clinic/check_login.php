<?php
	require_once "../php_backend/class/storage.php";

	session_start();

	if (isset($_POST['login_user'])) {

		$hd = Storage::getInstance();
		$hd->connect("GeracaoSaude");

        $permission_patient = $hd->login("paciente", $_POST['login_user'], $_POST['login_password']);        

        if ($permission_patient == 1) {

            $_SESSION['login_user'] = $_POST['login_user'];
            echo "0";
        }
        else {
            
            $permission_medic = $hd->login("medico", $_POST['login_user'], $_POST['login_password']);
        
            if ($permission_medic == 1) {

                $_SESSION['login_user'] = $_POST['login_user'];
                echo "1";
            }
            else {
                echo "-1";
            }
        }
	

		$hd->disconnect();
	}	
?>