$(document).ready(function () {
  cargaCliente();

  
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
    $("#SegundoApellido").val(Objeto.SegundoApellido).html(Objeto.SegundoApellido);
    $("#Telefono").val(Objeto.NumeroTelefono).html(Objeto.NumeroTelefono);
    $("#Correo").val(Objeto.Correo).html(Objeto.Correo);
    $("#Direccion").val(Objeto.Direccion).html(Objeto.Direccion);

}
