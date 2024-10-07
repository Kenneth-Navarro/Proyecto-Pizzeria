$(document).ready(function () {
  cargaPedidos();

  $(document).on("click", ".Eliminar", function () {
    var id = $(this).data("id");
    eliminar(id);
  });
});

function cargaPedidos() {
  const accion = "ObtenerPedidos";
  try {
    $.ajax({
      data: {
        accion: accion,
      },
      url: "../server/servidorPedido.php",
      type: "GET",
      datatype: "json",
    }).done(function (data) {
      LlenaTabla(data);
    });
  } catch (error) {
    alert(error);
  }
}


function LlenaTabla(TextoJSON) {
  let ObjetoJson = JSON.parse(TextoJSON);

  $("#tablaPedidos").append("<thead>");
  $("#tablaPedidos thead").append("<tr>");
  $("#tablaPedidos thead tr").append("<th scope='col'># </th>");
  $("#tablaPedidos thead tr").append("<th scope='col'>Fecha </th>");
  $("#tablaPedidos thead tr").append("<th scope='col'>Hora </th>");
  $("#tablaPedidos thead tr").append("<th scope='col'>Estado </th>");
  $("#tablaPedidos thead tr").append("<th scope='col'></th>");
  $("#tablaPedidos thead tr").append("<th scope='col'></th>");
  $("#tablaPedidos thead tr").append("<th scope='col'></th>");

  // Agrega el cuerpo de la tabla
  $("#tablaPedidos").append("<tbody class='table-group-divider'>");

  for (let i = 0; i < ObjetoJson.length; i++) {
    
    $("#tablaPedidos tbody").append("<tr>");
    $("#tablaPedidos tbody tr:last-child").append(
      "<th scope='row'>" + ObjetoJson[i].ID_Pedido + " </th>"
    );

    $("#tablaPedidos tbody tr:last-child").append(
      "<td scope='row'>" + ObjetoJson[i].Fecha + " </td>"
    );

    $("#tablaPedidos tbody tr:last-child").append(
      "<td scope='row'>" + ObjetoJson[i].Hora + " </td>"
    );

    $("#tablaPedidos tbody tr:last-child").append(
      "<td scope='row'>" + ObjetoJson[i].tipo + " </td>"
    );

    if (ObjetoJson[i].Pago == false) {
      $("#tablaPedidos tbody tr:last-child").append(
        "<td scope='row'>" + "<a class='botonosTabla btn btn-outline-primary' href='actualizarPedido.php?id=" +
      ObjetoJson[i].ID_Pedido +
      "'>Actualizar <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-repeat' viewBox='0 0 16 16'><path d='M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z'/><path fill-rule='evenodd' d='M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z'/></svg></a>"
      + " </td>"
      );
    }else{
      $("#tablaPedidos tbody tr:last-child").append(
        "<td scope='row'> </td>"
      );
    }

    $("#tablaPedidos tbody tr:last-child").append(
      "<td scope='row'>" + "<a class='botonosTabla btn btn-outline-success' href='verPedido.php?id=" +
      ObjetoJson[i].ID_Pedido +
      "'>Ver <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-folder2-open' viewBox='0 0 16 16'><path d='M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z'/></svg></a>"
 + " </td>"
    );

    $("#tablaPedidos tbody tr:last-child").append(
      "<td scope='row'>" +  "<button type='button' data-id='" +
      ObjetoJson[i].ID_Pedido +
      "' class='Eliminar botonosTabla btn btn-outline-danger'>Eliminar <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6a.5.5 0 0 0-1-.5Z'/><path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/></svg></button>"
 + " </td>"
    );
  }
}

function eliminar(id) {
  Swal.fire({
    title: "¿Estás seguro?",
    text: "¡Esto no se puede deshacer!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, estoy seguro",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const accion = "eliminar";
      try {
        $.ajax({
          data: {
            ID: id,
            accion: accion,
          },
          url: "../server/servidorPedido.php",
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
              icon: "warning",
              title: "Fallo!",
              text: r.responseText,
            });
          },
        });
      } catch (error) {
        alert(error);
      }
    } else {
      Swal.fire("Cancelado", "Tu acción ha sido cancelada.", "info");
    }
  });
}
