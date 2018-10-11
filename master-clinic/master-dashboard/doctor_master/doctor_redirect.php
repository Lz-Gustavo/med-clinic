<?php

    session_start();

    if (isset($_GET['id'])) {
        
        $_SESSION['clinic'] = $_GET['id'];
    }

    header("location: ../../../front_view/doctor_panel/doctor_panel.html");

?>