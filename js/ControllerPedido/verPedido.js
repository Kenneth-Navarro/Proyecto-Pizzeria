$(document).ready(function () {
    cargaPedido();
  
    
  });
  
  function cargaPedido() {
    let accion = "ObtenerPedido";
  
    try {
      $.ajax({
        data: {
          accion: accion,
        },
        url: "../server/servidorPedido.php?id=" + $("#id").val() + "",
        type: "GET",
        dataType: "json",
      }).done(function (data) {
        LlenaPedido(data);
      });
    } catch (error) {
      alert(error);
    }
  }
  
  function LlenaPedido(Objeto) {
    $("#ID_Cliente").val(Objeto.Cliente);
    $("#ID_Empleado").val(Objeto.Empleado);
    $("#Fecha").val(Objeto.Fecha);
    $("#Hora").val(Objeto.Hora);
    $("#ID_Estado").val(Objeto.Estado);

    $("#tablaProductosPedido").append("<thead>");
    $("#tablaProductosPedido thead").append("<tr>");
    $("#tablaProductosPedido thead tr").append("<th scope='col'>Nombre</th>");
    $("#tablaProductosPedido thead tr").append("<th scope='col'>Cantidad</th>");
    $("#tablaProductosPedido thead tr").append("<th scope='col'>Precio</th>");

    $("#tablaProductosPedido").append("<tbody class='table-group-divider'>");

    for (let i = 0; i < Objeto.Productos.length; i++) {
        $("#tablaProductosPedido tbody").append("<tr>");
        $("#tablaProductosPedido tbody tr:last-child").append(
            "<td>" + Objeto.Productos[i].Nombre + " </td>"
        );
        $("#tablaProductosPedido tbody tr:last-child").append(
            "<td>" + Objeto.Productos[i].Cantidad + " </td>"
        );
        $("#tablaProductosPedido tbody tr:last-child").append(
            "<td>" + Objeto.Productos[i].Precio + " </td>"
        );
    }
}
