<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$clave = (isset($_POST['clave'])) ? $_POST['clave'] : '';
$idRol = (isset($_POST['idRol'])) ? $_POST['idRol'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO personas (nombre, usuario, email, clave, idRol) VALUES('$nombre', '$usuario', '$email', '$clave', '$idRol') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, nombre, usuario, email, clave, idRol FROM personas ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación

        // $consulta = "UPDATE personas SET p.nombre='$nombre', p.usuario='$usuario', p.email='$email', p.clave='$clave',r.descripcion='$idRol' FROM personas p INNER JOIN roles r ON r.id=p.idRol WHERE id='$id' ";
        $consulta = "UPDATE personas SET nombre='$nombre', usuario='$usuario', email='$email', clave='$clave', idRol='$idRol' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT p.id, p.nombre, p.usuario, p.email, p.clave,r.descripcion FROM personas p INNER JOIN roles r ON r.id=p.idRol ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM personas WHERE id='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                     
        break;        

    case 4:    
        $consulta = "SELECT p.id, p.nombre, p.usuario, p.email, p.clave,r.descripcion FROM personas p INNER JOIN roles r ON r.id=p.idRol";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;