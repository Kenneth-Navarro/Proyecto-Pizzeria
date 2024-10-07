<?php include "../include/templates/header.php" ?>

<script type="text/javascript" src="../js/ControllerEmpleado/actualizaEmpleado.js"></script>
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
            <a class="activo navIndex" aria-current="page" href="">Actualizar</a>
        </li>
    </ul>
    <h1 class="margen">Actualización del Empleado</h1>
    <form class="formulario margen">
        <input type="hidden" name="id" id="id" value='<?php echo $id ?>'>
        <div>
            <label for="Cedula">Cédula:</label>
            <br>
            <input type="number" class="campoFormulario form-control" placeholder="Ingrese la cédula del Empleado"
                name="Cedula" id="Cedula" value="">
        </div>
        <div>
            <label for="Edad">Edad:</label>
            <br>
            <input type="number" class="campoFormulario form-control" placeholder="Ingrese la edad del Empleado"
                name="Edad" id="Edad" value="">
        </div>
        <div>
            <label for="Nombre">Nombre:</label>
            <br>
            <input type="text" class="campoFormulario form-control" placeholder="Ingrese el nombre del Empleado"
                name="Nombre" id="Nombre" value="">
        </div>
        <div>
            <label for="Puesto">Puesto:</label>
            <br>
            <select class="campoFormulario form-select" id="Puesto" name="Puesto" value="">
            </select>
        </div>
        <div>
            <label for="PrimerApellido">Primer Apellido:</label>
            <br>
            <input type="text" class="campoFormulario form-control"
                placeholder="Ingrese el primer apellido del Empleado" name="PrimerApellido" id="PrimerApellido"
                value="">
        </div>
        <div>
            <label for="Salario">Salario:</label>
            <br>
            <input type="number" class="campoFormulario form-control" placeholder="Ingrese el salario del Empleado"
                name="Salario" id="Salario" value="">
        </div>
        <div>
            <label for="SegundoApellido">SegundoApellido:</label>
            <br>
            <input type="text" class="campoFormulario form-control"
                placeholder="Ingrese el segundo apellido del Empleado" name="SegundoApellido" id="SegundoApellido"
                value="">
        </div>
        <div>
            <label for="FechaContratacion">Fecha de Contratacion:</label>
            <br>
            <input type="date" class="campoFormulario form-control" name="FechaContratacion" id="FechaContratacion"
                value="">
        </div>
        <div>
            <label for="Direccion">Direccion:</label>
            <br>
            <textarea name="Direccion" class="campoFormulario form-control"
                placeholder="Ingrese la dirección del Empleado" id="Direccion" cols="23" rows="10" value=""></textarea>
        </div>
        <div>
            <label for="Telefono">Teléfono:</label>
            <br>
            <input type="int" class="campoFormulario form-control" placeholder="Ingrese el télefono del Empleado"
                name="Telefono" id="Telefono" value="">
        </div>
        <div>
            <label for="Correo">Correo:</label>
            <br>
            <input type="email" class="campoFormulario form-control" placeholder="Ingrese el correo del Empleado"
                name="Correo" id="Correo" value="">
        </div>
        <br>

        <div class="divBotones">
            <a href="infoEmpleados.php" type="button" class="btn btn-secondary boton margenVolver">Volver</a>
            <input type="button" class="btn btn-success boton" id="Actualizar" value="Actualizar" name="Actualizar">
        </div>
    </form>


</main>

<?php include "../include/templates/footer.php" ?>