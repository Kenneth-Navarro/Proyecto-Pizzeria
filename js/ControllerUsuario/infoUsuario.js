$(document).ready(function () {
  cargaUsuarios();
  cargaEmpleados();


  //Para el maenjo de ocultar y mostrar la contraseña
  $("#checkVista").click(function () {
    if ($("#checkVista").prop("checked")) {
      $("#vista").html(
        '<svg class="eye vistaContrasena" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill " viewBox="0 0 16 16">' +
          '<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>' +
          '<path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>' +
          "</svg>"
      );

      $("#Contrasena").attr('type', 'text');
      $("#checkVista").css("background-color", "var(--rojo)");
    }else{
      $("#vista").html(
        '<svg class="eye vistaContrasena" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">'+
        '<path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588M5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>'+
        '<path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z"/>'+
        '</svg>'
      );
      
      $("#Contrasena").attr('type', 'password');
      $("#checkVista").css("background-color", "white");
    }
  });

  //Para el maenjo de ocultar y mostrar la contraseña
  $("#checkVista2").click(function () {
    if ($("#checkVista2").prop("checked")) {
      $("#vista2").html(
        '<svg class="eye vistaContrasena" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">' +
          '<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>' +
          '<path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>' +
          "</svg>"
      );

      $("#conContrasena").attr('type', 'text');
      $("#checkVista2").css("background-color", "var(--rojo)");
    }else{
      $("#vista2").html(
        '<svg class="eye vistaContrasena" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">'+
        '<path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588M5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>'+
        '<path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z"/>'+
        '</svg>'
      );
      
      $("#conContrasena").attr('type', 'password');
      $("#checkVista2").css("background-color", "white");
    }
  });

  $(document).on("click", ".Eliminar", function () {
    // Obtiene el valor del atributo "data-id" que contiene el id de la fila
    var id = $(this).data("id");

    eliminar(id);
  });
});

function cargaUsuarios() {

  const accion = "devuelveUsuarios";
  try {
    $.ajax({
      data: {
        accion: accion,
      },
      url: "../server/servidorUsuario.php",
      type: "GET",
      datatype: "json",
    }).done(function (data) {
      LlenaTabla(data);
    });
  } catch (error) {
    alert(error);
  }
}

function LlenaTabla(TextoJSON) {
  let ObjetoJson = JSON.parse(TextoJSON);
  
  // Agrega el encabezado
  $("#tablaUsuarios").append("<thead>");
  $("#tablaUsuarios thead").append("<tr>");
  $("#tablaUsuarios thead tr").append("<th scope='col'># </th>");
  $("#tablaUsuarios thead tr").append("<th scope='col'>Usuario </th>");
  $("#tablaUsuarios thead tr").append("<th scope='col'>Empleado </th>");
  $("#tablaUsuarios thead tr").append("<th scope='col'></th>");
  $("#tablaUsuarios thead tr").append("<th scope='col'></th>");
  $("#tablaUsuarios thead tr").append("<th scope='col'></th>");

  // Agrega el cuerpo de la tabla
  $("#tablaUsuarios").append("<tbody class='table-group-divider'>");

  // Itera sobre los elementos del objeto JSON y agrega las filas de datos
  for (let i = 0; i < ObjetoJson.length; i++) {
    $("#tablaUsuarios tbody").append("<tr>");
    $("#tablaUsuarios tbody tr:last-child").append(
      "<th scope='row'>" + (i+1) + " </th>"
    );
    $("#tablaUsuarios tbody tr:last-child").append(
      "<td scope='row'>" + ObjetoJson[i].Usuario + " </td>"
    );
    $("#tablaUsuarios tbody tr:last-child").append(
      "<td scope='row'>" +
        ObjetoJson[i].NombreEmpleado +
        " " +
        ObjetoJson[i].PrimerApellidoEmpleado +
        " </td>"
    );
    $("#tablaUsuarios tbody tr:last-child").append(
      "<td>" +
        "<a class=' botonosTabla btn btn-outline-primary' href='actualizarUsuario.php?id=" +
        ObjetoJson[i].Usuario +
        "'>Actualizar <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-repeat' viewBox='0 0 16 16'><path d='M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z'/><path fill-rule='evenodd' d='M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z'/></svg>        </a></td>"
    );
    $("#tablaUsuarios tbody tr:last-child").append(
      "<td>" +
        "<a class=' botonosTabla btn btn-outline-success' href='verUsuario.php?id=" +
        ObjetoJson[i].Usuario +
        "'>Ver <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-folder2-open' viewBox='0 0 16 16'><path d='M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z'/></svg></a></td>"
    );
    $("#tablaUsuarios tbody tr:last-child").append(
      "<td>" +
        "<button type='button' data-id='" +
        ObjetoJson[i].Usuario +
        "' class='Eliminar botonosTabla btn btn-outline-danger' name'eliminar' id='eliminar'>Eliminar <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/><path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/></svg></button></td>"
    );
  }
}

function eliminar(id) {
  Swal.fire({
    title: "¿Estás seguro?",
    text: "¡Esto no se puede deshacer!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, estoy seguro",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const accion = "eliminar";
      try {
        $.ajax({
          data: {
            ID: id,
            accion: accion,
          },
          url: "../server/servidorUsuario.php",
          type: "POST",
          dataType: "json",

          success: function (r) {
            Swal.fire({
              icon: "success",
              title: "¡Éxito!",
              text: r,
            }).then((result) => {
              if (result.isConfirmed) {
                location.reload();
              }
            });
          },
          error: function (r) {
            Swal.fire({
              icon: "warning", // Puedes usar 'warning', 'error', 'info', etc.
              title: "Fallo!",
              text: r.responseText,
            });
          },
        });
      } catch (error) {
        alert(error);
      }
    } else {
      Swal.fire("Cancelado", "Tu acción ha sido cancelada.", "info");
    }
  });
}

function cargaEmpleados(){
  let accion = "ObtenerEmpleados";

  try {
    $.ajax({
      data: {
        accion: accion,
      },
      url: "../server/servidorEmpleado.php",
      type: "GET",
      datatype: "json",
    }).done(function (data){
      LlenarEmpleados(data);
    });
  } catch (error) {
    alert(error);
  }
}

function LlenarEmpleados(TextoJSON){
  let Objeto = JSON.parse(TextoJSON);

  for (let i = 0; i < Objeto.length; i++) {
    const element = Objeto[i];
    
    $("#Empleado").append("<option value='"+ element.Cedula +"'>"+ element.Nombre + " "+ element.PrimerApellido +" "+ element.SegundoApellido +"</option>");
  }
}
