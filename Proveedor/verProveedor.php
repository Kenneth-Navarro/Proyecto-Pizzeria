<?php include "../include/templates/header.php";
require_once "../DAL/proveedorDAL.php"; ?>


<script type="text/javascript" src="../js/ControllerProveedor/actualizaProveedor.js"></script>

<?php
$id = $_GET['id'];
?>

<main class="container">
<ul class="nav margen">
        <li class="nav-item margenNav">
            <a class=" navIndex" aria-current="page" href="../principal.php">Inicio</a>
        </li>
        <li class="nav-item margenNav">
            <a class=" navIndex" aria-current="page" href="infoProveedor.php">Proveedores</a>
        </li>
        <li class="nav-item">
            <a class="activo navIndex" aria-current="page" href="">Ver</a>
        </li>
    </ul>
    <h1 class = "margen">Información del Proveedor</h1>
    <form class="formulario margen">
    <input type="hidden" id="id" name="id" value='<?php echo $id; ?>'>
                        <div class="">
                            <label for="Nombre">Nombre:</label>
                            <input type="text" name="Nombre" id="Nombre" class="campoFormulario form-control"
                                placeholder="Ingrese aquí el nombre" aria-label="Nombre" readonly>
                        </div>

                        <div class="">
                            <label for="Encargado">Encargado:</label>
                            <input type="text" name="Encargado" id="Encargado" class="campoFormulario form-control"
                                placeholder="Ingrese aquí la contraseña" aria-label="Encargado" readonly>
                        </div>

                        <div class="">
                            <label for="Telefono">Telefono:</label>
                            <input type="number" name="Telefono" id="Telefono" class="campoFormulario form-control"
                                placeholder="Ingrese aquí el telefono" aria-label="Telefono" readonly>
                        </div>
                        
                        <div class="">
                            <label for="Correo">Correo:</label>
                            <input type="text" name="Correo" id="Correo" class="campoFormulario form-control"
                                placeholder="Ingrese aquí el correo" aria-label="Correo" readonly>
                        </div>

                         <div style="grid-column-end: 3;">
            <a href="infoProveedor.php" class="btn btn-secondary boton">Volver</a>
        </div>


    </form>
</main>

<?php include "../include/templates/footer.php" ?>