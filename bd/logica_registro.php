<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$clave = (isset($_POST['clave'])) ? $_POST['clave'] : '';
$idRol = 2;




// $pass = md5($clave);  //Encriptacion de clave enviada por el usuario para compararla con la clave encriptada y almacenada en la bd

$consulta = $consulta = "INSERT INTO personas (nombre, usuario, email, clave, idRol) VALUES('$nombre', '$usuario', '$email', '$clave', '$idRol') ";;	
$resultado = $conexion->prepare($consulta);
$resultado -> execute();

print json_encode($data); //enviar el array final en formato json a JS
$conexion = null;

?>