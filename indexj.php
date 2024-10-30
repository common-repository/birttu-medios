<?php

include_once("estado_conexion.php");
//Comprueba la configuracion de la página de inicio

$v=file("config/configuracion.txt"); //Carga el archivo de configuración en un array


if(isset($log_id) && isset($log_tag_usuario) && (isset($log_password))){
    include_once("datos_sesion.php");
}

if (isset($v[0]) && $v[0]=="1\n"){
    include("index_1.php"); //Carga la index personalizada
}

else{
    include("index_0.php"); //Carga la index general
}
?>
