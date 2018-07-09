<?php

    require_once "../../php_backend/class/storage.php";
    require_once "../../php_backend/class/person.php";
    require_once "../../php_backend/class/doctor.php";

    $pk = $_POST['pk'];     // primary key
    $name = $_POST['name']; // nome do campo (consulta ou prescrição)
    $value = $_POST['value']; // valor setado

    $doctor = new Doctor("admin", "istrator", "1");

    if ($name == "notes") {
        $doctor->anotate($pk, $value, "dont_change");
    }
    else if ($name == "prescription") {
        $doctor->anotate($pk, "dont_change", $value);
    }
?>