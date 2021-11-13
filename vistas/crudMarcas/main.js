$(document).ready(function () {
  var id, opcion;
 
  //MOstrar
  opcion = 4;
  tablaMarcas = $("#tablaMarcas").DataTable({
    "ajax":{            
      "url": "../../bd/crudMarcas.php", 
      "method": 'POST', //usamos el metodo POST
      "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
      "dataSrc":""
  },
  "columns":[
      {"data": "id"},
      {"data": "nombre"},
      {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
  ]

  });
// console.log(tablaMarcas);

  var fila; //capturar la fila para editar o borrar el registro

  //EDITAR
  $(document).on("click", ".btnEditar", function () {
    opcion = 2; //editar
    fila = $(this).closest("tr");
    id = parseInt(fila.find("td:eq(0)").text());
    nombre = fila.find("td:eq(1)").text();
    
    $("#nombre").val(nombre);


    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar marca");
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
        url: "../../bd/crudMarcas.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, id: id },
        success: function () {
          tablaMarcas.row(fila.parents("tr")).remove().draw();
        },
      });
    }
  });

  //AGREGAR

  $("#btnNuevo").click(function () {
    $("#formMarcas").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva marca");
    $("#modalCRUD").modal("show");
    id = null;
    opcion = 1; //alta
  });

  //Boton Guardar
  $("#formMarcas").submit(function (e) {
    e.preventDefault();

    nombre = $.trim($('#nombre').val());
    
    $.ajax({
      url: "../../bd/crudMarcas.php",
      type: "POST",
      dataType: "json",
      data: {
        nombre: nombre,
        id: id,
        opcion: opcion,
      },
      success: function (data) {
        tablaMarcas.ajax.reload(null, false);
      },
    });
    $("#modalCRUD").modal("hide");
  });



});