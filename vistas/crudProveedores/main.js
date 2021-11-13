  var url=
$(document).ready(function () {
  var id, opcion;
  opcion = 4;
  tablaPersonas = $("#tablaPersonas").DataTable({
    "ajax":{            
      "url": "../../bd/crudProveedores.php", 
      "method": 'POST', //usamos el metodo POST
      "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
      "dataSrc":""
  },
  responsive: "true",
  dom: 'Bfrtilp',       
  buttons:[ 
  {
    extend:    'excelHtml5',
    text:      'EXCEL',
    titleAttr: 'Exportar a Excel',
    className: 'btn btn-success',
    exportOptions: {
      columns: [ 0, 1, 2, 3,4,5]
  },
  },
  {
    extend:    'pdfHtml5',
    text:      'PDF',
    titleAttr: 'Exportar a PDF',
    className: 'btn btn-danger',
    exportOptions: {
      columns: [ 0, 1, 2, 3,4,5]
  },
  },
],
  "columns":[
      {"data": "id"},
      {"data": "nombre"},
      {"data": "telefono"},
      {"data": "email"},
      {"data": "direccion"},
      {"data": "pagina"},
      {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
  ]

  });
// console.log(tablaPersonas);

  var fila; //capturar la fila para editar o borrar el registro

  //EDITAR
  $(document).on("click", ".btnEditar", function () {
    opcion = 2; //editar
    fila = $(this).closest("tr");
    id = parseInt(fila.find("td:eq(0)").text());
    nombre = fila.find("td:eq(1)").text();
    telefono = fila.find("td:eq(2)").text();
    email = fila.find("td:eq(3)").text();
    direccion = fila.find("td:eq(4)").text();
    pagina = fila.find("td:eq(5)").text();

    $("#nombre").val(nombre);
    $("#telefono").val(telefono);
    $("#email").val(email);
    $("#direccion").val(direccion);
    $("#pagina").val(pagina);


    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar proveedor");
    $("#modalCRUD").modal("show");
  });

  //BORRAR
  //Borrar
  $(document).on("click", ".btnBorrar", function () {
    opcion = 3; //eliminar
    fila = $(this);
    id = parseInt($(this).closest("tr").find("td:eq(0)").text());
    var respuesta = confirm("¿Está seguro de borrar el registro " + id + "?");
    if (respuesta) {
      $.ajax({
        url: "../../bd/crudProveedores.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, id: id },
        success: function () {
          tablaPersonas.row(fila.parents("tr")).remove().draw();
        },
      });
    }
  });

  $("#formPersonas").submit(function (e) {
    e.preventDefault();
    nombre = $.trim($('#nombre').val());
    telefono = $.trim($('#telefono').val());
    email = $.trim($('#email').val());
    direccion = $.trim($('#direccion').val());
    pagina = $.trim($('#pagina').val());
    $.ajax({
      url: "../../bd/crudProveedores.php",
      type: "POST",
      dataType: "json",
      data: {
        nombre: nombre,
        telefono: telefono,
        email: email,
        direccion: direccion,
        pagina: pagina,
        id: id,
        opcion: opcion,
      },
      success: function (data) {
        tablaPersonas.ajax.reload(null, false);
      },
    });
    $("#modalCRUD").modal("hide");
  });


  //AGREGAR
  $("#btnNuevo").click(function () {
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo proveedor");
    $("#modalCRUD").modal("show");
    id = null;
    opcion = 1; //alta
  });
});