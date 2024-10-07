$(document).ready(function () {
  cargaPuestos();
  cargaEmpleado();
  
  $("#Actualizar").click(function (){
    actualizarEmpleado(
      $("#Cedula").val(),
      $("#Nombre").val(),
      $("#PrimerApellido").val(),
      $("#SegundoApellido").val(),
      $("#Edad").val(),
      $("#Puesto").val(),
      $("#Salario").val(),
      $("#FechaContratacion").val(),
      $("#Direccion").val(),
      $("#Correo").val(),
      $("#Telefono").val(),
      $("#id").val()
    );
  })

  
});


function cargaEmpleado(){
  let accion = "ObtenerEmpleado";
  try {
    $.ajax({
      data: {
        accion: accion,
      },
      url: '../server/servidorEmpleado.php?id='+ $('#id').val() + '',
      type: 'GET',
      dataType: 'json',
    }).done(function (data){
      LlenaEmpleado(data)
    });
  } catch (error) {
    alert(error);
  }
};

function LlenaEmpleado(Objeto){
  $("#Cedula").val(Objeto.Cedula).html(Objeto.Cedula);
  $("#Edad").val(Objeto.Edad).html(Objeto.Edad);
  $("#Nombre").val(Objeto.Nombre).html(Objeto.Nombre);
  $("#PrimerApellido").val(Objeto.PrimerApellido).html(Objeto.PrimerApellido);
  $("#SegundoApellido").val(Objeto.SegundoApellido).html(Objeto.SegundoApellido);
  $("#Salario").val(Objeto.Salario).html(Objeto.Salario);
  $("#FechaContratacion").val(Objeto.FechaContratacion).html(Objeto.FechaContratacion);
  $("#Direccion").val(Objeto.Direccion).html(Objeto.Direccion);
  $("#Correo").val(Objeto.Correo).html(Objeto.Correo);
  $("#Telefono").val(Objeto.Telefono).html(Objeto.Telefono);
  $("#Puesto").val(Objeto.Puesto[0]);


};


function cargaPuestos(){
  const accion = "ObtenerPuestos";
  try {
    $.ajax({
      data: {
        accion: accion,
      },
      url: "../server/servidorEmpleado.php",
      type: "GET",
      datatype: "json",
    }).done(function (data) {
      LlenaPuestos(data);
    });
  } catch (error) {
    alert(error);
  }
};

function LlenaPuestos(TextoJSON){
  ObjetoJson = JSON.parse(TextoJSON);

  for (let j = 0; j < ObjetoJson.length; j++) {
    const element = ObjetoJson[j];
    $("#Puesto").append("<option value="+element.ID_Puesto+">"+element.NombrePuesto+"</option>");
  }
};

function actualizarEmpleado(Cedula, Nombre, PrimerApellido, SegundoApellido, Edad, Puesto,
  Salario, FechaContratacion, Direccion, Correo, Telefono, ID){

    let accion = "actualizar";

    try {
      $.ajax({
        data: {
          accion: accion,
          Cedula: Cedula,
          Nombre: Nombre,
          PrimerApellido:PrimerApellido,
          SegundoApellido:SegundoApellido,
          Edad: Edad,
          Puesto: Puesto,
          Salario: Salario,
          FechaContratacion: FechaContratacion,
          Direccion: Direccion,
          Correo: Correo,
          Telefono: Telefono,
          ID: ID,
        },
        url: '../server/servidorEmpleado.php',
        type: 'POST',
        dataType: 'json',

        success: function (r){
          Swal.fire({
            icon: "success", // Puedes usar 'warning', 'error', 'info', etc.
            title: "¡Éxito!!",
            text: r,
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href='../Empleados/infoEmpleados.php';
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