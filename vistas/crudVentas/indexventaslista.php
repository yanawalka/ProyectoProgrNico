<!DOCTYPE html>
<html lang="en">

<?php
include ("db2.php");
?>

<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="indexventas.css">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css" />
    <!-- Google Icon API -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<header>
<h4 class="text-center text-light">REALIZAR <span class="badge bg-danger">VENTA</span></h4> 
</header>
<body>

<div id="content">
    <div class="container-xl">
        <h2>LISTA DE VENTAS A CLIENTES</h2>
        <BR>
        <div class="table-responsive">
            <table id="tablaListaVentas"
                class="table table-striped" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Folio</th>
                        <th class="oc">Caja</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th style="width: 48px;">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-light"></tbody>
            </table>
        </div>
    </div>
</div>


<div id="backModalVentas">
            <div class="drowerVentas">
                <div class="headerModalVentas" >
                    <div class="d-flex justify-content-between">
                        <h3 class="tituloVentas">DETALLE DE VENTA</h3>
                        <button id="cerrarDrawerVentas" class="btn btn-danger">X</button>
                    </div>
                </div>
                <div class="p-3 flex-grow-1 bd-highlight">
                    <div class="table-responsive">
                        <table id="tablaHistorialVentasDos"
                            class="table table-striped" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Orden</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>SubTotal</th>
                                </tr>
                            </thead>
                            <tbody class="table-light"></tbody>
                        </table>
                    </div>
                </div>
                <div class="p-3 flex-grow-1 bd-highlight">
                    <div id="subTotalModalVentas">
                    </div>
                    <div class="footerModalVentas">
                            <div id="descuentoModalVentas">
                            </div>
                            <div id="totalModalVentas">
                            </div>
                    </div>
                </div>
            </div>
        </div>




</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- datatables JS -->
    <script src="datatables/datatables.min.js"></script>
    <script src="main.js"></script>


</html>