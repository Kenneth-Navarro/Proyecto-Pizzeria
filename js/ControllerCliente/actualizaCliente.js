$(document).ready(function () {
  cargaCliente();

  $("#Actualizar").click(function () {
    actualizaCliente($("#Cedula").val(),
    $("#nombre").val(),
    $("#PrimerApellido").val(),
    $("#SegundoApellido").val(),
    $("#Telefono").val(),
    $("#Correo").val(),
    $("#Direccion").val(),
    $("#id").val());
  });
});

function cargaCliente() {
  let accion = "ObtenerCliente";

  try {
    $.ajax({
      data: {
        accion: accion,
      },
      url: "../server/servidor.php?id=" + $("#id").val() + "",
      type: "GET",
      dataType: "json",
    }).done(function (data) {
      LlenaCliente(data);
    });
  } catch (error) {
    alert(error);
  }
}

function LlenaCliente(Objeto) {
  $("#Cedula").val(Objeto.Cedula).html(Objeto.Cedula);
  $("#nombre").val(Objeto.Nombre).html(Objeto.Nombre);
  $("#PrimerApellido").val(Objeto.PrimerApellido).html(Objeto.PrimerApellido);
  $("#SegundoApellido")
    .val(Objeto.SegundoApellido)
    .html(Objeto.SegundoApellido);
  $("#Telefono").val(Objeto.NumeroTelefono).html(Objeto.NumeroTelefono);
  $("#Correo").val(Objeto.Correo).html(Objeto.Correo);
  $("#Direccion").val(Objeto.Direccion).html(Objeto.Direccion);
}

function actualizaCliente(
  rCedula,
  rNombre,
  rPApellido,
  rSApellido,
  rTelefono,
  rCorreo,
  rDireccion,
  rID
) {
  const accion = "actualizar";

  try {
    $.ajax({
      data: {
        ID: rID,
        Cedula: rCedula,
        nombre: rNombre,
        PrimerApellido: rPApellido,
        SegundoApellido: rSApellido,
        Direccion: rDireccion,
        Telefono: rTelefono,
        Correo: rCorreo,
        accion: accion,
      },
      url: "../server/servidor.php",
      type: "POST",
      dataType: "json",

      success: function (r) {
        Swal.fire({
          icon: "success",
          title: "¡Éxito!",
          text: r,
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href='../Clientes/infoClientes.php';
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
}
