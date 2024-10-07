$(document).ready(function () {
    $("#Guardar").click(function () {
      InsertarProveedor( $("#Nombre").val(),$("#Encargado").val(), $("#Telefono").val(), $("#Correo").val());
    });
});



function InsertarProveedor(
    rNombre,
    rEncargado,
    rTelefono,
    rCorreo
  ) {
    const accion = "insertar";
  
    try {
      $.ajax({
        data: {
          Nombre: rNombre,
          Encargado: rEncargado,
          Telefono: rTelefono,
          Correo: rCorreo,
          accion: accion,
        },
        url: "../server/servidorProveedor.php",
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
  }