$(document).ready(function () {
  cargaPago();
  
});


function cargaPago(){
  let accion = "ObtenerPago";
  try {
    $.ajax({
      data: {
        accion: accion,
      },
      url: "../server/servidorPago.php?id="+ $('#id').val() + "",
      type: "GET",
      dataType: "json",
    }).done(function (data){
      LlenaPago(data)
    });
  } catch (error) {
    alert(error);
  }
};

function LlenaPago(Objeto) {
  $("#Nombre").val(Objeto.cliente.Nombre+" "+Objeto.cliente.PrimerApellido).html(Objeto.cliente.Nombre+" "+Objeto.cliente.PrimerApellido);
  $("#Metodo").val(Objeto.metodo.Metodo).html(Objeto.metodo.Metodo);
  $("#Monto").val(Objeto.pago.Monto).html(Objeto.pago.Monto);

// Limpiar la tabla antes de agregar nuevas filas

$("#tablaProductos").append("<thead>");
$("#tablaProductos thead").append("<tr>");
$("#tablaProductos thead tr").append("<th scope='col'>Producto </th>");
$("#tablaProductos thead tr").append("<th scope='col'>Cantidad </th>");
$("#tablaProductos thead tr").append("<th scope='col'>Precio </th>");

// Agrega el cuerpo de la tabla
$("#tablaProductos").append("<tbody class='table-group-divider'>");

// Itera sobre los elementos del objeto JSON y agrega las filas de datos
for (let i = 0; i <  Objeto.productos.length; i++) {
    $("#tablaProductos tbody").append("<tr>");
    $("#tablaProductos tbody tr:last-child").append("<th scope='row'>" +  Objeto.productos[i].Nombre+ " </th>");
    $("#tablaProductos tbody tr:last-child").append("<td scope='row'>" +  Objeto.productos[i].cantidad+ " </td>");
    $("#tablaProductos tbody tr:last-child").append("<td scope='row'>" +  Objeto.productos[i].Precio + " </td>");
 
}

}



