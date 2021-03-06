<!DOCTYPE html>
<html lang="en">

<?php
include ("db2.php");
?>

<head>
        <!-- Cosas del sistema -->
    <!-- <script src="https://kit.fontawesome.com/0f99dae2f5.js" crossorigin="anonymous"></script>
    <link href="../../../sistema/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet"   href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.  5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../../../sistema/js/icons.js"></script> -->


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
        <div>
        <a class="btn btn-secondary" href='indexventaslista.php'>HISTORAL DE VENTAS</a>
            <div class="d-flex bd-highlight" style="margin-top: 100px">
                <div class="tab-content" id="myTabContent">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">PRODUCTOS</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">CLIENTE</button>
                        </li>
                    </ul>
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="p-2 flex-grow-1 bd-highlight">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="tablaProductos"
                                            class="table table-striped" style="width:100%">

                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Codigo</th>
                                                    <th>Nombre</th>
                                                    <th>Categoria</th>
                                                    <th>Stock</th>
                                                    <th>Precio</th>
                                                    <th style="width: 48px;">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-light"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="p-2 flex-grow-1 bd-highlight">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="tablaPersonas" class="table table-striped" style="width:100%">

                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nombre</th>
                                                    <th>Email</th>
                                                    <th>Direccion</th>
                                                    <th>Telefono</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-light"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex-grow-1 bd-highlight" style="margin-left: 10px">
                <div class="row">
                    <div class="clientediv col-6" style="margin-bottom: 10px">
                        <div class="input-group-prepend">
                            <span class="input-group-text">CLIENTE:</span>
                        </div>
                        <label id="tablaClientesCli" class="form-control">S/C</label>
                    </div>
                    <div class="totalt col-6">
                    </div>
                    <div class="descuento col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">DESCUENTO:</span>
                        </div>
                        <input id="descuentito" class="form-control" value='0'>
                    </div>
                    <div class="totalt col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">TOTAL:</span>
                        </div>
                        <label id="total" class="form-control">0</label>
                    </div>
                </div>


                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Numero</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaProductosComp" class="table-light">
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success" id="btnFinalizarComp">Continuar</button>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
        <div id="backModal">
            <div class="drower">
                <div class="headerModal" >
                    <div class="d-flex justify-content-between">
                        <h3 class="tituloTicket">TICKET DE VENTA</h3>
                        <button id="cerrarDrawer" class="btn btn-danger">X</button>
                    </div>
                </div>
                <div class="headerDosModal">
                    <div id="facturaModal">
                    </div>
                    <div id="fechaDelDiaModal">
                    </div>
                </div>
                <div id="clienteModal">
                </div>
                <div class="p-3 flex-grow-1 bd-highlight">
                    <table class="table p-3" id="idModal">
                        <thead class="thead-light">
                            <tr>
                                <th>NOMBRE</th>
                                <th>PRECIO</th>
                                <th>CANTIDAD</th>
                                <th>SUBTOTAL C/U</th>
                            </tr>
                        </thead>
                        <tbody id="idModalBody">
                        </tbody>
                    </table>
                    <div id="subTotalModal">
                    </div>
                    <div class="footerModal">
                        <div id="descuentoModal">
                        </div>
                        <div id="totalModal">
                        </div>
                    </div>
                </div>
                <div class="footerModalDos">
                    <div class="d-flex justify-content-end">
                        <button id="cerrarDrawerVenta" class="btn btn-danger">CANCELAR VENTA</button>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button id="botoncModal" class="btn btn-success">FINALIZAR VENTA</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="backModalDos">
            <div class="drower">
                <div class="headerModal" >
                    <div class="d-flex justify-content-prepend">
                        <h2 class="tituloCompraEfectuada">Compra efectuada</h2>
                    </div>
                    <p class="parrafoCompraEfectuada">¿Deseas imprimir la compra?</p>
                </div>
                <div class="footerModalTres">
                    <div class="d-flex justify-content-prepend">
                        <button id="cerrarDrawerImprimir" class="btn btn-danger">CONTINUAR SIN IMPRIMIR</button>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button id="botonImprimirModal" class="btn btn-success">IMPRIMIR</button>
                    </div>
                </div>
            </div>
        </div>
</body>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>

    <script type="text/javascript" src="main.js"></script>


</html>