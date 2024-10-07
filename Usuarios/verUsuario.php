<?php include "../include/templates/header.php";
require_once "../DAL/empleadoDAL.php"; ?>


<script type="text/javascript" src="../js/ControllerUsuario/verUsuario.js"></script>

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
            <a class=" navIndex" aria-current="page" href="infoUsuario.php">Usuario</a>
        </li>
        <li class="nav-item">
            <a class="activo navIndex" aria-current="page" href="">Ver</a>
        </li>
    </ul>
    <h1 class="margen">Información del Usuario</h1>
    <form class="formulario margen">
        <input type="hidden" id="id" name="id" value='<?php echo $id; ?>'>
        <div>
            <label for="Usuario">Nombre de Usuario:</label>
            <input type="text" name="Usuario" id="Usuario" class="campoFormulario form-control" aria-label="Usuario"
                readonly>
        </div>

        <div>
            <label for="Rol">Rol:</label>
            <input type="text" class="form-control campoFormulario" name="Rol" id="Rol" readonly>
        </div>

        <div>
            <label for="Estado">Estado:</label>
            <input type="text" class="form-control campoFormulario" name="Estado" id="Estado" readonly>
        </div>

        <div>
            <label for="Empleado">Empleado:</label>
            <input type="text" class="form-control campoFormulario" name="Empleado" id="Empleado" readonly>
        </div>
        <br>

        <div class="divBotones">
            <a href="infoUsuario.php" class="btn btn-secondary boton">Volver</a>
        </div>


    </form>
</main>

<?php include "../include/templates/footer.php" ?>