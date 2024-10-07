$(document).ready(function () {
    cargaUsuario();
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
  