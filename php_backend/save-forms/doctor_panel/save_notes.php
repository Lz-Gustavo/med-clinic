<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once "../../class/storage.php";

    $pk = $_POST['pk'];
    $name = $_POST['name'];
    $value = $_POST['value'];

    //$text = $pk."-".$name."-".$value."\n";
    //$file = fopen("test.txt", "w");
    //fwrite($file, $text);
    //fclose($file);

    $db_instance = Storage::getInstance();
    $db_instance->connect("GeracaoSaude");

    $array = explode("!", $pk);
    
    $sql = "UPDATE GeracaoSaude.consultas SET ".$name."='".$value."' WHERE crm='".$array[0]."' AND dia='".$array[1]."' AND horario='".$array[2]."';";

    $file = fopen("test.txt", "w");
    fwrite($file, $sql);
    fclose($file);

    $db_instance->SQLinsert($sql);
    
    $db_instance->disconnect();
?>