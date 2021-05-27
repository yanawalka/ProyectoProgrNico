$(document).ready(function () {
  var id, opcion;
  opcion = 4;
  tablaPersonas = $("#tablaPersonas").DataTable({
    ajax: {
      url: "bd/crud.php",
      method: "POST", //usamos el metodo POST
      data: { opcion: opcion }, //enviamos opcion 4 para que haga un SELECT
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "nombre" },
      { data: "usuario" },
      { data: "email" },
      { data: "clave" },
      {
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>",
      },
    ],

    //Para cambiar el lenguaje a español
    language: {
      lengthMenu: "Mostrar _MENU_ registros",
      zeroRecords: "No se encontraron resultados",
      info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      sSearch: "Buscar:",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      sProcessing: "Procesando...",
    },
  });


  var fila; //capturar la fila para editar o borrar el registro

  //EDITAR
  $(document).on("click", ".btnEditar", function () {
    opcion = 2; //editar
    fila = $(this).closest("tr");
    id = parseInt(fila.find("td:eq(0)").text());
    nombre = fila.find("td:eq(1)").text();
    usuario = fila.find("td:eq(2)").text();
    email = fila.find("td:eq(3)").text();
    clave = fila.find("td:eq(4)").text();

    $("#nombre").val(nombre);
    $("#usuario").val(usuario);
    $("#email").val(email);
    $("#clave").val(clave);


    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona");
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
        url: "bd/crud.php",
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
    nombre = $.trim($("#nombre").val());
    usuario = $.trim($("#usuario").val());
    email = $.trim($("#email").val());
    clave = $.trim($("#clave").val());
    $.ajax({
      url: "bd/crud.php",
      type: "POST",
      dataType: "json",
      data: {
        nombre: nombre,
        usuario: usuario,
        email: email,
        clave: clave,
        id: id,
        opcion: opcion,
      },
      success: function (data) {
        tablaPersonas.ajax.reload(null, false);
      },
    });
    $("#modalCRUD").modal("hide");
  });
});
  //AGREGAR
  $("#btnNuevo").click(function () {
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Persona");
    $("#modalCRUD").modal("show");
    id = null;
    opcion = 1; //alta
  });