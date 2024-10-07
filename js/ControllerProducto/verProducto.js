$(document).ready(function () {
    cargaProducto();
  
    
  });
  
  function cargaProducto() {
    let accion = "ObtenerProducto";
  
    try {
      $.ajax({
        data: {
          accion: accion,
        },
        url: "../server/servidorProducto.php?id=" + $("#id").val() + "",
        type: "GET",
        dataType: "json",
      }).done(function (data) {
        LlenaProducto(data);
      });
    } catch (error) {
      alert(error);
    }
  }
  
  function LlenaProducto(Objeto) {
    $("#Nombre").val(Objeto.Nombre);
    $("#Descripcion").val(Objeto.Descripcion);
    $("#Precio").val(Objeto.Precio);
    $("#Tipo").val(Objeto.tipo);
    if (Objeto.proveedor != null) {
        $("#Proveedor").html(`<label for="Proveedor">Proveedor</label>
                              <input type="text" name="Proveedor" id="Proveedor" class="campoFormulario form-control" aria-label="Proveedor" readonly value="${Objeto.proveedor}">`);
    }
}

  