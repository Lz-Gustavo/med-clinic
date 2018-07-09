<?php

    //delay (for debug only)
    sleep(1); 

    $pk = $_POST['pk'];     // primary key
    $name = $_POST['name']; // nome do campo (consulta ou prescrição)
    $value = $_POST['value']; // valor setado

    print_r($_POST);
?>