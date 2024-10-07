<?php include "../include/templates/header.php" ?>

<script type="text/javascript" src="../js/ControllerCliente/verCliente.js"></script>
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
            <a class="activo navIndex" aria-current="page" href="">Ver</a>
        </li>
    </ul>
    <h1 class="margen">Información del Cliente</h1>
    <div class="formulario margen">
        <input type="hidden" id="id" name="id" value='<?php echo $id; ?>'>
        <div class="">
            <label for="Cedula:">Cédula</label>
            <input type="number" name="Cedula" id="Cedula" class="campoFormulario form-control"
                placeholder="Ingrese aquí la cédula" aria-label="Cedula" readonly>
        </div>
        <div class="">
            <label for="nombre:">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="campoFormulario form-control"
                placeholder="Ingrese aquí el nombre" aria-label="nombre" readonly>
        </div>

        <div class="">
            <label for="PrimerApellido">Primer Apellido</label>
            <input type="text" name="PrimerApellido" id="PrimerApellido" class="campoFormulario form-control"
                placeholder="Ingrese aquí el Primer Apellido" aria-label="Primer Apellido" readonly>
        </div>
        <div class=" ">
            <label for="SegundoApellido">Segundo Apellido</label>
            <input type="text" name="SegundoApellido" id="SegundoApellido" class="campoFormulario form-control"
                placeholder="Ingrese aquí el Segundo Apellido" aria-label="Segundo Apellido" readonly>
        </div>


        <div class=" ">
            <label for="Telefono">Teléfono</label>
            <input type="number" name="Telefono" id="Telefono" class="campoFormulario form-control"
                placeholder="Ingrese aquí el Teléfono" aria-label="Telefono" readonly>
        </div>
        <div class="">
            <label for="Correo">Correo</label>
            <input type="email" name="Correo" id="Correo" class="campoFormulario form-control"
                placeholder="Ingrese aquí el Correo" aria-label="Correo" readonly>
        </div>

        <div class="">
            <label for="Direccion">Direccion</label>
            <textarea name="Direccion" placeholder="Ingrese aquí la dirección" class="campoFormulario form-control"
                id="Direccion" cols="23" rows="10" readonly></textarea>
        </div>
        <br>



        <a href="infoClientes.php" class="btn btn-secondary boton">Volver</a>

    </div>


</main>

<?php include "../include/templates/footer.php" ?>