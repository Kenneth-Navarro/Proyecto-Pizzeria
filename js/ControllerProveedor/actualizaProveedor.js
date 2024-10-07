$(document).ready(function () {
  cargaProveedor();
  
    $("#Actualizar").click(function () {
      actualizaProveedor( $("#id").val(),$("#Nombre").val(),$("#Encargado").val(),$("#Telefono").val(),$("#Correo").val());
    });
  });
  
  function cargaProveedor() {
    let accion = "ObtenerProveedor";
  
    try {
      $.ajax({
        data: {
          accion: accion,
        },
        url: "../server/servidorProveedor.php?id=" + $("#id").val() + "",
        type: "GET",
        dataType: "json",
      }).done(function (data) {
        LlenaProveedor(data);
      });
    } catch (error) {
      alert(error);
    }
  }
  
  function LlenaProveedor(Objeto) {
    $("#Nombre").val(Objeto.Nombre).html(Objeto.Nombre);
    $("#Encargado").val(Objeto.Encargado).html(Objeto.Encargado);
    $("#Telefono").val(Objeto.Telefono).html(Objeto.Telefono);
    $("#Correo").val(Objeto.Correo).html(Objeto.Correo);
  }
  
  function actualizaProveedor(
    rID,
    rNombre,
    rEncargado,
    rTelefono,
    rCorreo
  ) {
    const accion = "actualizar";
  
    try {
      $.ajax({
        data: {
          ID: rID,
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
              window.location.href='../Proveedor/infoProveedor.php';
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
  