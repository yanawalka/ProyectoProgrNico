<?php
date_default_timezone_set("America/Argentina/Salta");
include_once 'db2.php';

// Recepción de los datos enviados mediante POST desde el JS   
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$cliente = (isset($_POST['cliente'])) ? $_POST['cliente'] : '';
$ventaproid = (isset($_POST['id'])) ? $_POST['id'] : '';
$ventaprecio = (isset($_POST['precio'])) ? $_POST['precio'] : '';
$ventacantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$ventaorden = (isset($_POST['orden'])) ? $_POST['orden'] : '';
$factura = (isset($_POST['factura'])) ? $_POST['factura'] : '';
$descuento = (isset($_POST['valordescuento'])) ? $_POST['valordescuento'] : '';
$subtotal = (isset($_POST['subtotal'])) ? $_POST['subtotal'] : '';
$total = (isset($_POST['total'])) ? $_POST['total'] : '';

$stockcantidadnueva = (isset($_POST['resultado'])) ? $_POST['resultado'] : '';

switch($opcion){        
    case 4: //select
        $consulta = "SELECT proid,procodigo,pronombre,canom,prostockactual,proprecio FROM productos INNER JOIN categorias ON productos.caid = categorias.caid";
        $resultado= mysqli_query($conn, $consulta);     
        $data= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        break;

    case 5: //agregarventacabeza
        $fecha = new DateTime();
        $fecha = $fecha->format('Y-m-d H:i:sP');
        $caja = 1;
        $consulta = "INSERT INTO facturasventas (clid, cjid, fvfechahora, fvdescuento, fvsubtotal, fvtotal) VALUES ('$cliente','$caja','$fecha',0,0,0)";
        $resultado= mysqli_query($conn, $consulta);     

        $consulta2 = "SELECT MAX(fvid) as factura FROM facturasventas";
        $resultado2= mysqli_query($conn, $consulta2);     
        $data= mysqli_fetch_all($resultado2, MYSQLI_ASSOC);
        break;


    case 6: //agregarventadetalle
        $preciototal = $ventacantidad*$ventaprecio;
        $consulta = "INSERT INTO detallesventas ( dvorden, fvid, proid, dvcantidad, dvpreciounitario, dcpreciototal) VALUES ('$ventaorden','$factura','$ventaproid','$ventacantidad','$ventaprecio','$preciototal')";
        $resultado= mysqli_query($conn, $consulta);     
        break;

    case 7: //actualizarventacabeza
        $consulta = "UPDATE facturasventas SET fvtotal='$total', fvdescuento='$descuento', fvsubtotal='$subtotal', fvtotal='$total'  WHERE fvid='$factura'";
        $resultado= mysqli_query($conn, $consulta);     
        break;

    case 8: //facturagenerica
        $consulta = "SELECT MAX(fvid) as factura FROM facturasventas";
        $resultado= mysqli_query($conn, $consulta);     
        $data= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        break;

    case 9: // restar producto saca stock
        $consulta = "SELECT prostockactual as stock FROM productos WHERE proid ='$ventaproid'";
        $resultado= mysqli_query($conn, $consulta);     
        $data= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        break;
    case 10: // restar producto updatea stock nuevo
        $consulta = "UPDATE productos SET prostockactual='$stockcantidadnueva' WHERE proid='$ventaproid'";
        $resultado= mysqli_query($conn, $consulta);     
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;