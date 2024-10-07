$(document).ready(function () {
  cargaMetodos();
    $("#pagarPedido").click(function (event) {
      event.preventDefault();  //evita que recargue la pagina
        var ID_Cliente = $("#ID_Cliente").val();
        var ID_Estado = $('input[name="estado"]:checked').val();
        var id=$("#id").val();
        var Productos = productosSeleccionados; 
        var ID_Metodo = $('input[name="metodo"]:checked').val();
      PagarPedido(ID_Cliente,ID_Estado, Productos, id,ID_Metodo);
   
    
      });
    
  });

function cargaMetodos() {
  const accion = "ObtenerMetodos";
  try {
    $.ajax({
      data: {
        accion: accion,
      },
      url: "../server/servidorPedido.php",
      type: "GET",
      datatype: "json",
    }).done(function (data) {
      LlenaMetodo(data);
    });
  } catch (error) {
    alert(error);
  }
}

function LlenaMetodo(TextoJSON) {
  ObjetoJson = JSON.parse(TextoJSON);
  for (let j = 0; j < ObjetoJson.length; j++) {
    const element = ObjetoJson[j];
    $("#ID_Metodo").append(
      "<div class='form-check'>" +
        "<input class='form-check-input' type='checkbox' value='" +
        element.ID_Metodo +
        "' id='metodo" +
        element.ID_Metodo +
        "' name='metodo' onchange='handleCheckboxChange1(this)'>" +
        "<label class='form-check-label' for='metodo" +
        element.ID_Metodo +
        "'>" +
        element.Metodo +
        "</label>" +
      "</div>"
    );
  }
}


function handleCheckboxChange1(checkbox) {
  if (checkbox.checked) {
    // Desmarcar todos los demás checkboxes
    $('input[name="metodo"]').not(checkbox).prop('checked', false);
  }
}

function PagarPedido(
    rID_Cliente, rID_Estado, rProductos, rid,rMetodo

  ) {
    const accion = "pagar";
    try {
        $.ajax({
            data: {
                ID_Cliente: rID_Cliente,
                ID_Estado:rID_Estado,
                Productos:rProductos,
                ID_Pedido:rid,
                ID_Metodo:rMetodo,
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
                window.location.replace('../Pagos/infoPago.php');

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
  

