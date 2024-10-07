$(document).ready(function (){
  cargaPagos();
   
    $(document).on('click', '.Eliminar', function() {
      // Obtiene el valor del atributo "data-id" que contiene el id de la fila
      var id = $(this).data('id');
  
      eliminar(id);
    });

})

function cargaEmpleados() {
  const accion = "ObtenerEmpleados";
  try {
    $.ajax({
      data: {
        accion: accion,
      },
      url: "../server/servidorUsuario.php",
      type: "GET",
      datatype: "json",
    }).done(function (data) {
      LlenaEmpleados(data);
    });
  } catch (error) {
    alert(error);
  }
}

function LlenaEmpleados(TextoJSON) {
  let ObjetoJson = JSON.parse(TextoJSON);
  let select = document.getElementById("Empleado");
  select.innerHTML = "";
  let optionDefault = document.createElement("option");
  optionDefault.value = ""; 
  optionDefault.text = "Seleccione el empleado";
  select.appendChild(optionDefault);

  for (let i = 0; i < ObjetoJson.length; i++) {
      let option = document.createElement("option");
      option.value = ObjetoJson[i].Cedula;
      option.text = ObjetoJson[i].Nombre + ' ' + ObjetoJson[i].PrimerApellido + ' ' + ObjetoJson[i].SegundoApellido ;
      select.appendChild(option);
  }
}

function cargaPagos(){
    const accion = "devuelvePagos";
    try {
        $.ajax(
            {
             data: {
                accion: accion,
             },
             url: '../server/servidorPago.php',
             type: 'GET',
             datatype: 'json',
        })
        .done(function (data){
            LlenaTabla(data);
        });
    } catch (error) {
        alert(error);
    }
}


function LlenaTabla(TextoJSON){
    let ObjetoJson = JSON.parse(TextoJSON);

    // Agrega el encabezado
    $("#tablaPagos").append("<thead>");
    $("#tablaPagos thead").append("<tr>");
    $("#tablaPagos thead tr").append("<th scope='col'># </th>");
    $("#tablaPagos thead tr").append("<th scope='col'>Número Pedido </th>");
    $("#tablaPagos thead tr").append("<th scope='col'>Monto </th>");
    $("#tablaPagos thead tr").append("<th scope='col'>Metodo de Pago </th>");
    $("#tablaPagos thead tr").append("<th scope='col'>Cliente </th>");
    $("#tablaPagos thead tr").append("<th scope='col'></th>");
    $("#tablaPagos thead tr").append("<th scope='col'></th>");
    $("#tablaPagos thead tr").append("<th scope='col'></th>");

    // Agrega el cuerpo de la tabla
    $("#tablaPagos").append("<tbody class='table-group-divider'>");

    // Itera sobre los elementos del objeto JSON y agrega las filas de datos
    for (let i = 0; i < ObjetoJson.length; i++) {
        $("#tablaPagos tbody").append("<tr>");
        $("#tablaPagos tbody tr:last-child").append("<th scope='row'>" + ObjetoJson[i].ID_Pago + " </th>");
        $("#tablaPagos tbody tr:last-child").append("<td scope='row'>" + ObjetoJson[i].ID_Pedido + " </td>");
        $("#tablaPagos tbody tr:last-child").append("<td scope='row'>" + ObjetoJson[i].Monto + " </td>");
        $("#tablaPagos tbody tr:last-child").append("<td scope='row'>" + ObjetoJson[i].MetodoPago.Metodo+ " </td>");
        $("#tablaPagos tbody tr:last-child").append("<td scope='row'>" + ObjetoJson[i].Cliente.Nombre + " </td>");

     
          $("#tablaPagos tbody tr:last-child").append(
            "<td>" +
              "<a class=' botonosTabla btn btn-outline-success' href='verPago.php?id=" +
              ObjetoJson[i].ID_Pago +
              "'>Ver <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-folder2-open' viewBox='0 0 16 16'><path d='M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z'/></svg></a></td>"
          );
        
    }
    

}


