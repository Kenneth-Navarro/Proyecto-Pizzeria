$(document).ready(function () {
    $("#Guardar").click(function () {
        InsertarUsuarios($("#Usuario").val(),  $("#Contrasena").val(), $("#conContrasena").val(), $("#Empleado").val(), $("#Rol").val());
    });
});



function InsertarUsuarios(
    rUsuario,
    rContrasena,
    rconContrasena,
    rEmpleado,
    rRol
  ) {
    const accion = "insertar";
  
    try {
      $.ajax({
        data: {
          Usuario: rUsuario,
          Contrasena: rContrasena,
          conContrasena: rconContrasena,
          Empleado: rEmpleado,
          Rol: rRol,
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
  }