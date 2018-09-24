<?php

    require_once "../../class/storage.php";

    $mon = $_POST["mon"];
    $tue = $_POST["tue"];
    $wed = $_POST["wed"];
    $thu = $_POST["thu"];
    $fri = $_POST["fri"];

    $week_array = array(
        "Seg:" => $_POST['mon'],
        "Ter:" => $_POST['tue'],
        "Qua:" => $_POST['wed'],
        "Qui:" => $_POST['thu'],
        "Sex:" => $_POST['fri'],
    );
    $hd = Storage::getInstance();
    $hd->modify_week($_POST['crm'], $week_array);
?>