<?php include "../include/templates/header.php" ?>


<script type="text/javascript" src="../js/ControllerCliente/actualizaCliente.js"></script>
<?php
$id = $_GET['id'];
?>

<main class="container">
    <ul class="nav margen">
        <li class="nav-item margenNav">
            <a class=" navIndex" aria-current="page" href="../principal.php">Inicio</a>
        </li>
        <li class="nav-item margenNav">
            <a class="navIndex" aria-current="page" href="infoClientes.php">Clientes</a>
        </li>
        <li class="nav-item">
            <a class="activo navIndex" aria-current="page" href="">Actualizar</a>
        </li>
    </ul>
    <h1 class="margen">Actualización del Cliente</h1>
    <form class="formulario margen">
        <input type="hidden" id="id" name="id" value='<?php echo $id; ?>'>
        <div class="">
            <label for="Cedula:">Cédula:</label>
            <input type="number" name="Cedula" id="Cedula" class="campoFormulario form-control"
                placeholder="Ingrese aquí la cédula" aria-label="Cedula" required>
        </div>
        <div class="">
            <label for="nombre:">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="campoFormulario form-control"
                placeholder="Ingrese aquí el nombre" aria-label="nombre" required>
        </div>

        <div class="">
            <label for="PrimerApellido">Primer Apellido:</label>
            <input type="text" name="PrimerApellido" id="PrimerApellido" class="campoFormulario form-control"
                placeholder="Ingrese aquí el Primer Apellido" aria-label="Primer Apellido" required>
        </div>
        <div class=" ">
            <label for="SegundoApellido">Segundo Apellido:</label>
            <input type="text" name="SegundoApellido" id="SegundoApellido" class="campoFormulario form-control"
                placeholder="Ingrese aquí el Segundo Apellido" aria-label="Segundo Apellido" required>
        </div>


        <div class=" ">
            <label for="Telefono">Teléfono:</label>
            <input type="number" name="Telefono" id="Telefono" class="campoFormulario form-control"
                placeholder="Ingrese aquí el Teléfono" aria-label="Telefono" required>
        </div>
        <div class="">
            <label for="Correo">Correo:</label>
            <input type="email" name="Correo" id="Correo" class="campoFormulario form-control"
                placeholder="Ingrese aquí el Correo" aria-label="Correo" required>
        </div>

        <div class="">
            <label for="Direccion">Direccion:</label>
            <textarea name="Direccion" placeholder="Ingrese aquí la dirección" class="campoFormulario form-control"
                id="Direccion" cols="23" rows="10" required></textarea>
        </div>
        <br>

        <div class="divBotones">
            <a href="infoClientes.php" class="btn btn-secondary boton margenVolver">Volver</a>
            <input type="button" class="btn btn-success boton" name="Actualizar" id="Actualizar" value="Actualizar">
        </div>


    </form>

</main>

<?php include "../include/templates/footer.php" ?>