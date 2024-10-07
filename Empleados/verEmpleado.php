<?php include "../include/templates/header.php" ?>

<script type="text/javascript" src="../js/ControllerEmpleado/verEmpleado.js"></script>
<?php
$id = $_GET['id'];
?>


<main class="container">
    <?php if ($_SESSION['Logueado']['Rol'] == 0) {
        header("Location: ../principal.php");
    } ?>
    <ul class="nav margen">
        <li class="nav-item margenNav">
            <a class=" navIndex" aria-current="page" href="../principal.php">Inicio</a>
        </li>
        <li class="nav-item margenNav">
            <a class=" navIndex" aria-current="page" href="infoEmpleados.php">Empleados</a>
        </li>
        <li class="nav-item">
            <a class="activo navIndex" aria-current="page" href="">Ver</a>
        </li>
    </ul>
    <h1 class="margen">Información del Empleado</h1>
    <div class="formulario margen">
        <input type="hidden" name="id" id="id" value='<?php echo $id ?>'>
        <div>
            <label for="Cedula">Cédula:</label>
            <br>
            <input type="number" class="campoFormulario form-control" name="Cedula" id="Cedula" readonly>
        </div>
        <div>
            <label for="Edad">Edad:</label>
            <br>
            <input type="number" class="campoFormulario form-control" name="Edad" id="Edad" value="" readonly>
        </div>
        <div>
            <label for="Nombre">Nombre:</label>
            <br>
            <input type="text" class="campoFormulario form-control" name="Nombre" id="Nombre" value="" readonly>
        </div>
        <div>
            <label for="Puesto">Puesto:</label>
            <br>
            <input class="campoFormulario form-control" id="Puesto" name="Puesto" value="" readonly>

        </div>
        <div>
            <label for="PrimerApellido">Primer Apellido:</label>
            <br>
            <input type="text" class="campoFormulario form-control" name="PrimerApellido" id="PrimerApellido" value=""
                readonly>
        </div>
        <div>
            <label for="Salario">Salario:</label>
            <br>
            <input type="number" class="campoFormulario form-control" name="Salario" id="Salario" value="" readonly>
        </div>
        <div>
            <label for="SegundoApellido">SegundoApellido:</label>
            <br>
            <input type="text" class="campoFormulario form-control" name="SegundoApellido" id="SegundoApellido" value=""
                readonly>
        </div>
        <div>
            <label for="FechaContratacion">Fecha de Contratacion:</label>
            <br>
            <input type="date" class="campoFormulario form-control" name="FechaContratacion" id="FechaContratacion"
                value="" readonly>
        </div>
        <div>
            <label for="Direccion">Direccion:</label>
            <br>
            <textarea name="Direccion" class="campoFormulario form-control" id="Direccion" cols="23" rows="10" value=""
                readonly></textarea>
        </div>
        <div>
            <label for="Telefono">Teléfono:</label>
            <br>
            <input type="int" class="campoFormulario form-control" name="Telefono" id="Telefono" value="" readonly>
        </div>
        <div>
            <label for="Correo">Correo:</label>
            <br>
            <input type="email" class="campoFormulario form-control" name="Correo" id="Correo" value="" readonly>
        </div>
        <br>
        <div class="divBotones">
            <a href="infoEmpleados.php" type="button" class="btn btn-secondary boton">Volver</a>
        </div>
    </div>


</main>

<?php include "../include/templates/footer.php" ?>