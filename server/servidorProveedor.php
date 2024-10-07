<?php
require_once "../DAL/proveedorDAL.php";
require_once "../include/functions/recoge.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === "insertar") {
        // Llama a la función "insertarCliente"
        insertarProveedor();
    } else if (isset($_POST['accion']) && $_POST['accion'] === "actualizar") {
        actualizaProveedor();
    }else if (isset($_POST['accion']) && $_POST['accion'] === "eliminar") {
        eliminar();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] === "devuelveProveedores"){
        devuelveProveedores();
    }else if(isset($_GET["accion"]) && $_GET["accion"] === "ObtenerProveedor"){
        devuelveProveedor();

    }
    //devuelveUsuario();
}




function insertarProveedor()
{
    $nombre = recogePost('Nombre');
    $encargado = recogePost('Encargado');
    $telefono = recogePost('Telefono');
    $correo = recogePost('Correo');

 
    $nombreOK = false;
    $encargadoOK= false;
    $telefonoOK = false;
    $correoOK = false;

    if($nombre == ""){
        print "No se ha insertado un nombre";
    }else{
        $nombreOK = true;
    }

    if($encargado == ""){
        print "No se ha insertado un encargado";
    }else{
        $encargadoOK = true;
    }

    if ($telefono == "") {
        print "No se ha insertado un teléfono";
    } else {
        // Verificar que el teléfono tenga al menos 8 caracteres
        if (strlen($telefono) < 8) {
            print "El teléfono debe tener al menos 8 caracteres";
        } elseif (strlen($telefono) > 8) {
            print "El teléfono no debe tener más de 8 caracteres";
        } else {
            $telefonoOK = true;
        }
    }
    

    if ($correo == "") {
        print "No se ha ingresado el correo del proveedor.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        print "No se ha ingresado un correo válido del proveedor.";
    } else {
        $correoOK = true;
    }

if($nombreOK && $encargadoOK && $telefonoOK && $correoOK){
    $respuesta = IngresoProveedor($nombre,$encargado,$telefono,$correo);
       if($respuesta == "No se pudo ingresar el proveedor"){
        print"No se pudo ingresar el Proveedor";
       }else{
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
       }
    
}
}

function devuelveProveedor()
{
    $ID=$_GET['id'];
    $sql = "select ID_Proveedor, Nombre, Encargado, Telefono, Correo FROM proveedor WHERE ID_Proveedor =  {$ID}";
    $proveedor =  ObtenerProveedor($sql);
    $proveedor['ID'] = $ID;
    echo json_encode($proveedor, JSON_UNESCAPED_UNICODE);
}

function devuelveProveedores()
{
  
    $sql = "select ID_Proveedor, Nombre, Encargado, Telefono FROM proveedor";
    $proveedor =  ObtenerProveedores($sql);
    echo json_encode($proveedor, JSON_UNESCAPED_UNICODE);
    
}


function actualizaProveedor(){
    $ID = recogePost("ID");
    $nombre = recogePost('Nombre');
    $encargado = recogePost('Encargado');
    $telefono = recogePost('Telefono');
    $correo = recogePost('Correo');

    $nombreOK = false;
    $encargadoOK= false;
    $telefonoOK = false;
    $correoOK = false;

    if($nombre == ""){
        print "No se ha insertado un nombre";
    }else{
        $nombreOK = true;
    }

    if($encargado == ""){
        print "No se ha insertado un encargado";
    }else{
        $encargadoOK = true;
    }

   
    if ($telefono == "") {
        print "No se ha insertado un teléfono";
    } else {
        // Verificar que el teléfono tenga al menos 8 caracteres
        if (strlen($telefono) < 8) {
            print "El teléfono debe tener al menos 8 caracteres";
        } elseif (strlen($telefono) > 8) {
            print "El teléfono no debe tener más de 8 caracteres";
        } else {
            $telefonoOK = true;
        }
    }

    if ($correo == "") {
        print "No se ha ingresado el correo del proveedor.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        print "No se ha ingresado un correo válido del proveedor.";
    } else {
        $correoOK = true;
    }

if($nombreOK && $encargadoOK && $telefonoOK && $correoOK){
    $respuesta = actualizarProveedor($nombre,$encargado,$telefono,$correo,$ID);
       if($respuesta == "Error al actualizar"){
        print"No se pudo actualizar el Proveedor";
       }else{
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
       }
    
}}

function eliminar(){
    $idEliminar = recogePost("ID");
    $respuesta = eliminarProveedor($idEliminar);
    if ($respuesta == "Error al eliminar el Proveedor. "){
        print "No se pudo eliminar el proveedor.";
    }else{
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
}


?>