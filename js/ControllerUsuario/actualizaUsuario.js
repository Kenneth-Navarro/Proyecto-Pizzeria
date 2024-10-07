$(document).ready(function () {
    cargaUsuario();
  
    $("#Actualizar").click(function () {
      actualizaUsuario( ID=$("#id").val(),$("#Usuario").val(), $("#Rol").val(), $("input[name='Estado']:checked").val());
    });

    $("#ActualizarContraseña").click(function () {
      actualizaUsuarioContrasena( ID=$("#id").val(),$("#Contrasena").val(), $("#conContrasena").val());
    });



    //Para el maenjo de ocultar y mostrar la contraseña
  $("#checkVista").click(function () {
    if ($("#checkVista").prop("checked")) {
      $("#vista").html(
        '<svg class="eye vistaContrasena" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">' +
          '<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>' +
          '<path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>' +
          "</svg>"
      );

      $("#Contrasena").attr('type', 'text');
      $("#checkVista").css("background-color", "var(--rojo)");
    }else{
      $("#vista").html(
        '<svg class="eye vistaContrasena" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">'+
        '<path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588M5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>'+
        '<path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z"/>'+
        '</svg>'
      );
      
      $("#Contrasena").attr('type', 'password');
      $("#checkVista").css("background-color", "white");
    }
  });

  //Para el maenjo de ocultar y mostrar la contraseña
  $("#checkVista2").click(function () {
    if ($("#checkVista2").prop("checked")) {
      $("#vista2").html(
        '<svg class="eye vistaContrasena" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">' +
          '<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>' +
          '<path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>' +
          "</svg>"
      );

      $("#conContrasena").attr('type', 'text');
      $("#checkVista2").css("background-color", "var(--rojo)");
    }else{
      $("#vista2").html(
        '<svg class="eye vistaContrasena" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">'+
        '<path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588M5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>'+
        '<path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z"/>'+
        '</svg>'
      );
      
      $("#conContrasena").attr('type', 'password');
      $("#checkVista2").css("background-color", "white");
    }
  });


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
    $("#Rol").val(Objeto.Rol);
    $("input[name='Estado'][value='" + Objeto.Estado + "']").prop('checked', true);
  }
  
  function actualizaUsuario(
    rID,
    rUsuario,
    rRol,
    rEstado
  ) {
    const accion = "actualizar";
  
    try {
      $.ajax({
        data: {
          ID: rID,
          Usuario: rUsuario,
          Rol: rRol,
          Estado: rEstado,
          accion: accion,
        },
        url: "../server/servidorUsuario.php",
        type: "POST",
        dataType: "json",
  
        success: function (r) {
          Swal.fire({
            icon: "success",
            title: "¡Éxito!",
            text: r,
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href='../Usuarios/infoUsuario.php';
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

  function actualizaUsuarioContrasena(rID, rContrasena, rconContrasena){
    let accion = "actualizarContrasena";

    try {
      $.ajax({
        data: {
          accion: accion,
          ID: rID,
          Contrasena: rContrasena,
          conContrasena: rconContrasena,
        },
        url: "../server/servidorUsuario.php",
        type: "POST",
        dataType: "json",

        success: function (r) {
          Swal.fire({
            icon: "success",
            title: "¡Éxito!",
            text: r,
          });
          limpiaCampos();
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
  

  function limpiaCampos(){
    $("#Contrasena").val("").html(""); 
    $("#conContrasena").val("").html("");
  }