<?php

    session_start();

    if (isset($_GET['id'])) {
        
        $_SESSION['clinic'] = $_GET['id'];

        if ($_GET['id'] == 1)
            header("location: ../../../front_view/doctor_panel/doctor_panel.html");
		
		else if ($_GET['id'] == 2)
			header("location: ../../../clinica2/front_view/doctor_panel/doctor_panel.html");

		else
			header("location: ../../../clinica3/front_view/doctor_panel/doctor_panel.html");
    }

?>