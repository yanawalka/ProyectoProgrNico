<?php
include_once 'db2.php';


$folio = (isset($_POST['folio'])) ? $_POST['folio'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch($opcion){
    case 1: // cambia la anulacion de venta
        $consulta = "UPDATE facturasventas SET is_delete = 1 WHERE fvid = '$folio'";
        $resultado= mysqli_query($conn, $consulta);     
        $data= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        break;   
    case 2: // select de detalle de ventas del modal
        $consulta = "SELECT fvdescuento, fvsubtotal, fvtotal FROM facturasventas WHERE fvid = '$folio'";
        $resultado= mysqli_query($conn, $consulta);     
        $data= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        break;   
    case 3: // select de detalle de ventas del modal
        $consulta = "SELECT dvorden, pronombre, dvcantidad, dvpreciounitario, dcpreciototal FROM detallesventas INNER JOIN productos ON detallesventas.proid = productos.proid AND fvid = '$folio'";
        $resultado= mysqli_query($conn, $consulta);     
        $data= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        break;    

    case 4: // select de historial de ventas
        $consulta = "SELECT fvid, cjid, fvfechahora, clnom, fvtotal FROM facturasventas INNER JOIN clientes ON facturasventas.clid = clientes.clid AND is_delete = 0";
        $resultado= mysqli_query($conn, $consulta);     
        $data= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        break;

    case 5: // ver estado de venta
        $consulta = "SELECT is_check as chequeo FROM facturasventas WHERE fvid = '$folio'";
        $resultado= mysqli_query($conn, $consulta);     
        $data= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        break;
    case 6: // actualizar stock
        $consulta = "SELECT * FROM detallesventas WHERE fvid = '$folio'";
        $resultado= mysqli_query($conn, $consulta);     
        $data= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        break;
    case 7: // actualizar estado de venta
        $consulta = "UPDATE facturasventas SET is_check = 1 WHERE fvid = '$folio'";
        $resultado= mysqli_query($conn, $consulta);      
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;