$(document).ready(function () {
    cargaClientes();
    cargaBebidas();
    cargaComidas();
    actualizarTabla();


    $("#guardarPedido").click(function (event) {
      event.preventDefault();
        var ID_Cliente = $("#ID_Cliente").val();
        var ID_Empleado = $("#ID_Empleado").val();
        var Productos = productosSeleccionados; 
       

        ingresaPedido(ID_Cliente, ID_Empleado, Productos);
      });

        //Obtener los productos de la tabla
    $("#agregarComida").click(function () {
      var ID_Comida = $("#ID_Comida").val();
      ProductoNuevo(ID_Comida);
  
    });

    $("#agregarBebida").click(function () {
      var ID_Comida = $("#ID_Bebida").val();
      ProductoNuevo(ID_Comida);
  
    });

  });

  var productosSeleccionados = []; //Array para almacenar los productos en la tabla

function cargaClientes() {
    const accion = "ObtenerClientes";
    try {
      $.ajax({
        data: {
          accion: accion,
        },
        url: "../server/servidor.php",
        type: "GET",
        datatype: "json",
      }).done(function (data) {
        LlenaClientes(data);
      });
    } catch (error) {
      alert(error);
    }
  }

  function LlenaClientes(TextoJSON) {
    ObjetoJson = JSON.parse(TextoJSON);
    $("#ID_Cliente").empty();
    $("#ID_Cliente").append("<option value=''>Seleccione un cliente</option>");
    for (let j = 0; j < ObjetoJson.length; j++) {
        const element = ObjetoJson[j];
        $("#ID_Cliente").append("<option value="+element.Cedula+">"+element.Nombre+ " " +element.PrimerApellido +"</option>");
    }
}




function cargaComidas() {
    const accion = "ObtenerComidas";
    try {
      $.ajax({
        data: {
          accion: accion,
        },
        url: "../server/servidorPedido.php",
        type: "GET",
        datatype: "json",
      }).done(function (data) {
        LlenaComidas(data);
      });
    } catch (error) {
      
    }
  }

  function LlenaComidas(TextoJSON) {
    ObjetoJson = JSON.parse(TextoJSON);
    $("#ID_Comida").empty();
    $("#ID_Comida").append("<option value=''>Seleccione la comida</option>").addClass('opcionesSelect');
    for (let j = 0; j < ObjetoJson.length; j++) {
      const element = ObjetoJson[j];
      $("#ID_Comida").append("<option value="+element.ID_Producto+ " data-precio=" + element.Precio +">"+element.Nombre+"</option>");
    }
}

function cargaBebidas() {
    const accion = "ObtenerBebidas";
    try {
      $.ajax({
        data: {
          accion: accion,
        },
        url: "../server/servidorPedido.php",
        type: "GET",
        datatype: "json",
      }).done(function (data) {
        LlenaBebidas(data);
      });
    } catch (error) {
      
    }
  }

  function LlenaBebidas(TextoJSON) {
    ObjetoJson = JSON.parse(TextoJSON);
    $("#ID_Bebida").empty();
    $("#ID_Bebida").append("<option value=''>Seleccione la bebida </option>");
    for (let j = 0; j < ObjetoJson.length; j++) {
        const element = ObjetoJson[j];
        $("#ID_Bebida").append("<option value=" + element.ID_Producto + " data-precio=" + element.Precio + ">" + element.Nombre + "</option>");
    }
}


  function ingresaPedido(rID_Cliente, rID_Empleado, rProductos) {
    const accion = "insertar";

    try {
        $.ajax({
            data: {
                ID_Cliente: rID_Cliente,
                ID_Empleado: rID_Empleado,
                Productos:rProductos,
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
                      window.location.replace('../Pedidos/infoPedido.php');
                        
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
      const accion = "eliminar"
      try {
        $.ajax({
          data: {
            ID: id,
            accion: accion,
          },
          url: '../server/servidorProducto.php',
          type: "POST",
          dataType: "json",

          success: function (r) {
            Swal.fire({
              icon: "success",
              title: "¡Éxito!",
              text: r,
            }).then((result) => {
              if (result.isConfirmed) {
                
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
      };
    } else {
      
      Swal.fire("Cancelado", "Tu acción ha sido cancelada.", "info");
    }
  });
}


//carga el producto que se desea agregar a la tabla
function cargaProducto(id) {
  let accion = "ObtenerProducto";

  
  return new Promise(function (resolve, reject) {
      $.ajax({
          data: {
              accion: accion,
          },
          url: "../server/servidorProducto.php?id=" + id,
          type: "GET",
          dataType: "json",
      }).done(function (data) {
         
          resolve(data);
      }).fail(function (error) {
          
          reject(error);
      });
  });
}


/*----------------------------------------------------Gestion de la tabla ----------------------------------------------------------------------------- */

function actualizarTabla() {
  var cuerpoTabla = $('#tablaProductos tbody');
  cuerpoTabla.empty();

  productosSeleccionados.forEach(function (producto, index) {
      var fila = cuerpoTabla[0].insertRow();
      var nombreCell = $(fila.insertCell(0));
      var cantidadCell = $(fila.insertCell(1));
      var precioCell = $(fila.insertCell(2));

      nombreCell.text(producto.nombre);

      // Crear el contenedor btn-group
      var btnGroup = $('<div>').addClass('btn-group').attr('role', 'group').attr('aria-label', 'Default button group');

      
      var menosButton = $('<button>').addClass('btn btn-danger').text('-').click(function () {
          if (producto.cantidad > 1) {
              producto.cantidad -= 1;
          } else {
            // Elimina el producto del array si la cantidad es 1
              productosSeleccionados.splice(index, 1);
          }
          actualizarTabla();
      });

      // Crea un elemento span para mostrar la cantidad actual del producto
      var cantidadSpan = $('<span>').addClass('cantidad-texto pl-3 pr-3 text-danger m-1 ').text(producto.cantidad);


      var masButton = $('<button>').addClass('btn btn-danger').text('+').click(function () {
          producto.cantidad = parseInt(producto.cantidad) + 1;
          actualizarTabla();
      });

      // Agregar botones al contenedor btn-group
      btnGroup.append(menosButton);
      btnGroup.append(cantidadSpan);
      btnGroup.append(masButton);
      cantidadCell.append(btnGroup);

      precioCell.text(producto.precio);
  });

  actualizarEstadoBotonGuardar();
}




//habilita y deshabilita el boton guardar dependiendo si hay prodductos en el arreglo
function actualizarEstadoBotonGuardar() {
  var botonGuardar = $("#guardarPedido"); 

  if (productosSeleccionados.length > 0) {
      botonGuardar.prop('disabled', false);
  } else {
      botonGuardar.prop('disabled', true);
  }
}

//Agrega productos al Arreglo
function agregarProducto(productoID, productoNombre, productoPrecio,cantidad) {
  cantidad = cantidad || 1; // si no se pasa el parametro de cantidad inicializa en 1

  // Busca si ya existe un producto con el mismo ID en el arreglo 'productosSeleccionados'
  var productoExistente = productosSeleccionados.find(function(item) {
      return item.id === productoID;
  });

  //si el producto existe aumenta la cantidad de este
  if (productoExistente) {
      productoExistente.cantidad += cantidad;
  } else {

      productosSeleccionados.push({
          id: productoID,
          nombre: productoNombre,
          cantidad: cantidad,
          precio: productoPrecio
      });
  }


  actualizarTabla();
  actualizarEstadoBotonGuardar();
}


function ProductoNuevo(id) {
  cargaProducto(id)
      .then(function (data) {
          var nombre = data.Nombre;
          var Precio = data.Precio;
          agregarProducto(id, nombre, Precio);
      })
      .catch(function (error) {
          
      });
}
