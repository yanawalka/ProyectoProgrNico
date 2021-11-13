<?php
include_once 'db2.php';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 4: // select cliente
        $consulta = "SELECT * FROM clientes";
        $resultado= mysqli_query($conn, $consulta);     
        $data= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;