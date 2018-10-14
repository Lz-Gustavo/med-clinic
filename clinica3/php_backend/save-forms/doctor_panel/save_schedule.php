<?php

    require_once "../../class/storage.php";

    session_start();

    $mon = $_POST["mon"];
    $tue = $_POST["tue"];
    $wed = $_POST["wed"];
    $thu = $_POST["thu"];
    $fri = $_POST["fri"];

    $week_array = array(
        "crm" => $_SESSION['login_crm'],
        "seg" => $_POST['mon'],
        "ter" => $_POST['tue'],
        "qua" => $_POST['wed'],
        "qui" => $_POST['thu'],
        "sex" => $_POST['fri'],
    );

    //$text = $_SESSION['login_crm']."-".$_POST['mon']."-".$_POST['tue']."-".$_POST['wed']."-".$_POST['thu']."-".$_POST['fri']."\n";

    $hd = Storage::getInstance();
    $hd->connect("GeracaoSaude");
    $hd->modify_week($week_array);
    $hd->disconnect();
?>