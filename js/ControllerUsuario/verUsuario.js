$(document).ready(function () {
  cargaUsuario();
});

function cargaUsuario() {
  let accion = "ObtenerUsuario";

  try {
    $.ajax({
      data: {
        accion: accion,
      },
      url: "../server/servidorUsuario.php?id=" + $("#id").val() + "",
      type: "GET",
      dataType: "json",
    }).done(function (data) {
      LlenaUsuario(data);
    });
  } catch (error) {
    alert(error);
  }

  
}

function LlenaUsuario(Objeto) {
  $("#Usuario").val(Objeto.Usuario).html(Objeto.Usuario);
  if(Objeto.Rol == 0){
    $("#Rol").val("Usuario").html("Usuario");
  }else{
    $("#Rol").val("Administrador").html("Administrador");
  }

  if(Objeto.Estado == 0){
    $("#Estado").val("Inactivo").html("UsInactivouario");
  }else{
    $("#Estado").val("Activo").html("Activo");
  }


  $("#Empleado").val(Objeto.NombreEmpleado+ " "+ Objeto.PrimerApellidoEmpleado).html(Objeto.NombreEmpleado+ " "+ Objeto.PrimerApellidoEmpleado);
}
