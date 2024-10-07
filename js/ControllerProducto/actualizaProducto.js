$(document).ready(function () {
    cargaProducto();
    cargaTipos();
    
  
    $("#Actualizar").click(function () {
      actualizaProducto(
      $("#Nombre").val(),
      $("#Descripcion").val(),
      $("#Precio").val(),
      $("#ID_tipo").val(),
      $("#ID_Proveedor").val(),
      $("#id").val());
    });

    $("#ID_tipo").change(function () {
      var nombreTipoSeleccionado = $(this).find('option:selected').text();
      var selectProveedor = $('#Proveedor');
      
      if (nombreTipoSeleccionado === "Bebida") {
          cargaProveedores();
      } else {
          selectProveedor.hide();
          $("#ID_Proveedor").val(""); //Le quita el valor al ID_Proveedor ya el el hide solo lo oculta
      }
    });
    

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


    if (Objeto.tipo === "Bebida") {
        cargaProveedores();
        // asigna del proveedor después de que se hayan cargado los proveedores
        setTimeout(function() {
            if (Objeto.ID_Proveedor != null) {
                $("#ID_Proveedor").val(Objeto.ID_Proveedor);
            }
        }, 50); // tiempo que espera (milisegundos)
    }   
     $("#Nombre").val(Objeto.Nombre);
    $("#Descripcion").val(Objeto.Descripcion);
    $("#Precio").val(Objeto.Precio);
    setTimeout(function() {
    $("#ID_tipo").val(Objeto.ID_Tipo);
  }, 50); 
}

  function cargaTipos() {
    const accion = "ObtenerTipos";
    try {
      $.ajax({
        data: {
          accion: accion,
        },
        url: "../server/servidorProducto.php",
        type: "GET",
        datatype: "json",
      }).done(function (data) {
        console.log(data);
        LlenaTipos(data);
      });
    } catch (error) {
      alert(error);
    }
  }

  function LlenaTipos(TextoJSON) {
    let ObjetoJson = JSON.parse(TextoJSON);
    let select = document.getElementById("ID_tipo");

    // Limpiar el elemento de selección
    select.innerHTML = "";

    for (let i = 0; i < ObjetoJson.length; i++) {
        let option = document.createElement("option");
        option.value = ObjetoJson[i].ID_Tipo;
        option.text = ObjetoJson[i].Nombre;
        select.appendChild(option);
    }
}


function cargaProveedores() {
  const accion = "ObtenerProveedores";
  try {
    $.ajax({
      data: {
        accion: accion,
      },
      url: "../server/servidorProducto.php",
      type: "GET",
      datatype: "json",
    }).done(function (data) {
      LlenaProveedores(data);
      $('#Proveedor').show();
    });
  } catch (error) {
    alert(error);
  }
}



function LlenaProveedores(TextoJSON) {
  let ObjetoJson = JSON.parse(TextoJSON);
  let select = document.getElementById("ID_Proveedor");
  select.innerHTML = "";

  for (let i = 0; i < ObjetoJson.length; i++) {
    let option = document.createElement("option");
    option.value = ObjetoJson[i].ID_Proveedor;
    option.text = ObjetoJson[i].Nombre;
    select.appendChild(option);
  }
}


function cargaProductos() {
  const accion = "ObtenerProductos";
  try {
    $.ajax({
      data: {
        accion: accion,
      },
      url: "../server/servidorProducto.php",
      type: "GET",
      datatype: "json",
    }).done(function (data) {
      LlenaTabla(data);
    });
  } catch (error) {
    alert(error);
  }
}

  
  function actualizaProducto(
    rNombre,
    rDescripcion,
    rPrecio,
    rTipo,
    rProveedor,
    rID

  ) {
    const accion = "actualizar";
    try {
        $.ajax({
        data: {
          Nombre: rNombre,
          Descripcion: rDescripcion,
          Precio: rPrecio,
          Tipo: rTipo,
          Proveedor: rProveedor,
          ID: rID,
          accion: accion,

        },
        
        url: "../server/servidorProducto.php",
        type: "POST",
        dataType: "json",
  
        success: function (r) {
          Swal.fire({
            icon: "success",
            title: "¡Éxito!",
            text: r,
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href='../Productos/infoProducto.php';
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
  