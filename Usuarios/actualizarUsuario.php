<?php include "../include/templates/header.php";
require_once "../DAL/empleadoDAL.php"; ?>


<script type="text/javascript" src="../js/ControllerUsuario/actualizaUsuario.js"></script>

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
            <a class=" navIndex" aria-current="page" href="infoUsuario.php">Usuarios</a>
        </li>
        <li class="nav-item">
            <a class="activo navIndex" aria-current="page" href="">Actualizar</a>
        </li>
    </ul>
    <!-- Modal -->
    <div class="modal fade" id="modalNuevo" tabindex="-1" aria-labelledby="modalNuevo" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bordeModel">
                <div class="modal-header encabezadoNuevo">
                    <h2 class="textoEncabezadoModal modal-title text-center" id="encabezadoNew">Actualizar
                        Contraseña
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <!-- Formulario dentro del modal -->
                    <form class="formContrasena">
                        <div class="">
                            <label for="Contrasena">Contraseña Nueva:</label>
                            <input type="password" name="Contrasena" id="Contrasena"
                                class="campoFormulario form-control" placeholder="Ingrese aquí la contraseña"
                                aria-label="Contrasena" required>
                            <div class="form-check form-switch" style="color: var(--rojo)">
                                <input class="form-check-input" type="checkbox" role="switch" id="checkVista">
                                <label id="vista" name="vista" class="form-check-label" for="checkVista">
                                    <svg class="eye vistaContrasena" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-eye-slash-fill"
                                        viewBox="0 0 16 16">'+
                                        <path
                                            d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588M5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                        <path
                                            d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z" />
                                    </svg>
                                </label>
                            </div>
                        </div>

                        <div class="">
                            <label for="conContrasena">Confirmar Contraseña:</label>
                            <input type="password" name="conContrasena" id="conContrasena"
                                class="campoFormulario form-control" placeholder="Ingrese de nuevo la contraseña"
                                aria-label="conContrasena" required>
                            <div class="form-check form-switch" style="color: var(--rojo)">
                                <input class="form-check-input" type="checkbox" role="switch" id="checkVista2">
                                <label id="vista2" name="vista2" class="form-check-label" for="checkVista2">
                                    <svg class="eye vistaContrasena" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-eye-slash-fill"
                                        viewBox="0 0 16 16">'+
                                        <path
                                            d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588M5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                        <path
                                            d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z" />
                                    </svg>
                                </label>
                            </div>
                        </div>

                        <br>

                        <input type="button" class="btn btn-success boton" name="ActualizarContraseña"
                            id="ActualizarContraseña" value="Actualizar">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <h1 class="margen">Actualización del Usuario</h1>
    <form class="formulario margen">
        <input type="hidden" id="id" name="id" value='<?php echo $id; ?>'>
        <div>
            <label for="Usuario">Nombre de Usuario:</label>
            <input type="text" name="NombreUsuario" id="Usuario" class="campoFormulario form-control"
                placeholder="Ingrese aquí el nombre" aria-label="Usuario" required>
        </div>

        <div>
            <label for="Rol">Rol:</label>
            <select id="Rol" name="Rol" class="campoFormulario form-select">
                <option value="0">Usuario</option>
                <option value="1">Administrador</option>
            </select>
        </div>

        <div>
            <label for="estados">Estado:</label>
            <div id="estados">
                <input type="radio" class="btn-check" name="Estado" value="0" id="Inactivo" autocomplete="off">
                <label class="btn btn-outline-danger botonesEstados" for="Inactivo"><b>Inactivo</b></label>

                <input type="radio" class="btn-check " name="Estado" value="1" id="Activo" autocomplete="off">
                <label class="btn btn-outline-success botonesEstados" for="Activo"><b>Activo</b></label>
            </div>
        </div>
        <div>
            <button type="button" class="botonContrasena btn" data-bs-toggle="modal" data-bs-target="#modalNuevo">
                <b>Actualizar Contraseña <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16'
                        fill='currentColor' class='bi bi-arrow-repeat' viewBox='0 0 16 16'>
                        <path
                            d='M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z' />
                        <path fill-rule='evenodd'
                            d='M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z' />
                    </svg></b>
            </button>
        </div>

        <div class="divBotones">
            <a href="infoUsuario.php" class="btn btn-secondary boton margenVolver">Volver</a>
            <input type="button" class="btn btn-success boton" name="Actualizar" id="Actualizar" value="Actualizar">
        </div>


    </form>
</main>

<?php include "../include/templates/footer.php" ?>