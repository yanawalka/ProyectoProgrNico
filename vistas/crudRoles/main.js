$(document).ready(function () {
  alert("perrito")
  var id, opcion;
  opcion = 4;
  tablaMarcas = $("#tablaMarcas").DataTable({
    "ajax":{            
      "url": "../../bd/crudRoles.php", 
      "method": 'POST', //usamos el metodo POST
      "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
      "dataSrc":""
  },
  "columns":[
      {"data": "id"},
      {"data": "descripcion"},
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
    descripcion = fila.find("td:eq(1)").text();
    $("#descripcion").val(descripcion);


    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar rol");
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
        url: "../../bd/crudRoles.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, id: id },
        success: function () {
          tablaMarcas.row(fila.parents("tr")).remove().draw();
        },
      });
    }
  });

  $("#formMarcas").submit(function (e) {
    e.preventDefault();
    descripcion = $.trim($('#descripcion').val());
    $.ajax({
      url: "../../bd/crudRoles.php",
      type: "POST",
      dataType: "json",
      data: {
        descripcion: descripcion,
        id: id,
        opcion: opcion,
      },
      success: function (data) {
        tablaMarcas.ajax.reload(null, false);
      },
    });
    $("#modalCRUD").modal("hide");
  });


  //AGREGAR
  $("#btnNuevo").click(function () {
    $("#formMarcas").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo rol");
    $("#modalCRUD").modal("show");
    id = null;
    opcion = 1; //alta
  });
});