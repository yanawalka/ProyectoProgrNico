<?php

session_start();

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


//COMPROBAR CONEXION
// print_r($conexion);


// Recepción de los datos enviados mediante POST desde el JS   
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$clave = (isset($_POST['clave'])) ? $_POST['clave'] : '';

// $pass = md5($clave);  //Encriptacion de clave enviada por el usuario para compararla con la clave encriptada y almacenada en la bd

$consulta = "SELECT personas.idRol AS idRol, roles.descripcion AS rol FROM personas JOIN roles ON personas.idRol=roles.id WHERE usuario='$usuario' AND clave='$clave'";	
$resultado = $conexion->prepare($consulta);
$resultado -> execute();

if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["s_usuario"] = $usuario;
    $_SESSION["s_idRol"] = $data[0]["idRol"];
    $_SESSION["s_rol_descripcion"] = $data[0]["rol"];
}else{
    $_SESSION["s_usuario"] = null;
    $data = null;
}

print json_encode($data); //enviar el array final en formato json a JS
$conexion = null;
?>