<?php
    $db_servername ="localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "aplicacion_restaurante";

    $coon = new mysqli($db_servername,$db_username,$db_password,$db_name);
    $coon->set_charset("utf8");
    
    #Probar Conexion
    if($coon->connect_error){
        die("Conexion Fallida" .$coon->connect_error);
    }else{
    }
?>