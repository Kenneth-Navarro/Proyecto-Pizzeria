<?php
require_once "../DAL/clienteDAL.php";
require_once "../include/functions/recoge.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === "insertar") {
        // Llama a la función "insertarCliente"
        insertarCliente();
    } else if (isset($_POST['accion']) && $_POST['accion'] === "actualizar") {
        actualizaCliente();
    } else if (isset($_POST['accion']) && $_POST['accion'] === "eliminar") {
        eliminar();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] === "ObtenerClientes") {
        devuelveClientes();
    } else if (isset($_GET["accion"]) && $_GET["accion"] === "ObtenerCliente") {
        devuelveCliente();
    }
}



function insertarCliente()
{
    $cedula = recogePost("Cedula");
    $nombre = recogePost("nombre");
    $prApellido = recogePost("PrimerApellido");
    $seApellido = recogePost("SegundoApellido");
    $direccion = recogePost("Direccion");
    $telefono = recogePost("Telefono");
    $correo = recogePost("Correo");

    $cedulaOK = false;
    $nombreOK = false;
    $prApellidoOK = false;
    $seApellidoOK = false;
    $direccionOK = false;
    $telefonoOK = false;
    $correoOK = false;


    if ($cedula == "") {
        print "No se ha ingresado la cédula del Cliente.";
    } elseif (!is_numeric($cedula)) {
        print "El dato de la cédula del Cliente no es válido.";
    } elseif(strlen($cedula) != 9){
        print "La cédula no es válida. La cedula debe contener 9 números.";
    }else {
        $cedulaOK = true;
    }


    if ($nombre == "") {
        print "No se ha ingresado el nombre del Cliente.";
    } else {
        $nombreOK = true;
    }

    if ($prApellido == "") {
        print "No se ha ingresado el primer apellido del Cliente.";
    } else {
        $prApellidoOK = true;
    }

    if ($seApellido == "") {
        print "No se ha ingresado el segundo apellido del Cliente.";

    } else {
        $seApellidoOK = true;
    }

    if ($direccion == "") {
        print "No se ha ingresado la dirección del Cliente.";
    } else {
        $direccionOK = true;
    }

    if ($telefono == "") {
        print "No se ha ingresado el télefono del Cliente.";
    } elseif (!is_numeric($telefono)) {
        print "El dato del télefono del Cliente no es válido.";
    } elseif(strlen(strlen($telefono) != 8)){
        print "El telefono no es válido. Debe tener 8 números.";
    }else {
        $telefonoOK = true;
    }

    if ($correo == "") {
        print "No se ha ingresado el correo del Cliente.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        print "No se ha ingresado un correo válido del Cliente.";
    } else {
        $correoOK = true;
    }


    if ($cedulaOK && $nombreOK && $prApellidoOK && $seApellidoOK && $direccionOK && $telefonoOK && $correoOK) {
        $respuesta = IngresoClientes($cedula, $nombre, $prApellido, $seApellido, $direccion, $telefono, $correo);
        if ($respuesta == "No se pudo ingresar el cliente ") {
            print "No se pudo ingresar el Cliente.";
        } else {
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }


}


function devuelveCliente()
{
    $cedulaID = recogeGet("id");
    $sql = "Select Cedula, Nombre, PrimerApellido, SegundoApellido, Direccion, NumeroTelefono, Correo  from cliente where Cedula = {$cedulaID}";
    $cliente = ObtenerCliente($sql);
    $ID = $cliente['Cedula'];
    $cliente['ID'] = $ID;

    echo json_encode($cliente, JSON_UNESCAPED_UNICODE);
}

function devuelveClientes()
{
    $sql = "Select Cedula, Nombre, PrimerApellido, SegundoApellido from cliente";
    $clientes = ObtenerClientes($sql);


    echo json_encode($clientes, JSON_UNESCAPED_UNICODE);
}


function actualizaCliente()
{
    $ID = recogePost("ID");
    $cedula = recogePost("Cedula");
    $nombre = recogePost("nombre");
    $prApellido = recogePost("PrimerApellido");
    $seApellido = recogePost("SegundoApellido");
    $direccion = recogePost("Direccion");
    $telefono = recogePost("Telefono");
    $correo = recogePost("Correo");

    $cedulaOK = false;
    $nombreOK = false;
    $prApellidoOK = false;
    $seApellidoOK = false;
    $direccionOK = false;
    $telefonoOK = false;
    $correoOK = false;


    if ($cedula == "") {
        print "No se ha ingresado la cédula del Cliente.";
    } elseif (!is_numeric($cedula)) {
        print "El dato de la cédula del Cliente no es válido.";
    } elseif(strlen($cedula) != 9){
        print "Cédula inválida. La cedula debe contener 9 números.";
    }else {
        $cedulaOK = true;
    }


    if ($nombre == "") {
        print "No se ha ingresado el nombre del Cliente.";
    } else {
        $nombreOK = true;
    }

    if ($prApellido == "") {
        print "No se ha ingresado el primer apellido del Cliente.";
    } else {
        $prApellidoOK = true;
    }

    if ($seApellido == "") {
        print "No se ha ingresado el segundo apellido del Cliente.";

    } else {
        $seApellidoOK = true;
    }

    if ($direccion == "") {
        print "No se ha ingresado la dirección del Cliente.";
    } else {
        $direccionOK = true;
    }

    if ($telefono == "") {
        print "No se ha ingresado el télefono del Cliente.";
    } elseif (!is_numeric($telefono)) {
        print "El dato del télefono del Cliente no es válido.";
    } elseif(strlen($telefono) != 8){
        print "El telefono no es válido. Debe tener 8 números.";
    }else {
        $telefonoOK = true;
    }

    if ($correo == "") {
        print "No se ha ingresado el correo del Cliente.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        print "No se ha ingresado un correo válido del Cliente.";
    } else {
        $correoOK = true;
    }



    if ($cedulaOK && $nombreOK && $prApellidoOK && $seApellidoOK && $direccionOK && $telefonoOK && $correoOK) {
        $respuesta = actualizarCliente($cedula, $nombre, $prApellido, $seApellido, $direccion, $telefono, $correo, $ID);
        if ($respuesta == "Error al actualizar el cliente ") {
            print "No se pudo actualizar el Cliente.";
        } else {
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }
}


function eliminar()
{
    $idEliminar = recogePost("ID");
    $respuesta = eliminarCliente($idEliminar);
    if ($respuesta == "Error al eliminar el cliente ") {
        print "No se pudo eliminar el Cliente.";
    } else {
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
    

    

}
?>