<?php
include "../include/templates/header.php";
require_once "../DAL/usuarioDAL.php";
require_once "../DAL/empleadoDAL.php";
require_once "../include/functions/recoge.php"; ?>

<script type="text/javascript" src="../js/ControllerUsuario/infoUsuario.js"></script>
<script type="text/javascript" src="../js/ControllerUsuario/insertarUsuario.js"></script>


<main class="container">
    <?php if ($_SESSION['Logueado']['Rol'] == 0) {
        header("Location: ../principal.php");
    } ?>
    <ul class="nav margen">
        <li class="nav-item margenNav">
            <a class=" navIndex" aria-current="page" href="../principal.php">Inicio</a>
        </li>
        <li class="nav-item margenNav">
            <a class=" navIndex activo" aria-current="page" href="infoEmpleados.php">Usuarios</a>
        </li>
    </ul>
    <button type="button" class="botonNuevo btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevo">
        <b>Nuevo Usuario <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg></b>
    </button>
    <!-- Modal -->
    <div class="modal fade" id="modalNuevo" tabindex="-1" aria-labelledby="modalNuevo" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered d-flex justify-content-center align-items-center">
            <div class="modal-content modalConfig bordeModel">
                <div class="modal-header encabezadoNuevo">
                    <h2 class="textoEncabezadoModal modal-title text-center" id="encabezadoNew">Nuevo Usuario</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario dentro del modal -->
                    <form class="formularioModal">
                        <div class="">
                            <label for="Usuario">Nombre de Usuario:</label>
                            <input type="text" name="Usuario" id="Usuario" class="campoFormulario form-control"
                                placeholder="Ingrese aquí el nombre" aria-label="Usuario" required>
                        </div>
                        <div class="">
                            <label for="Contrasena">Contraseña:</label>
                            <input type="password" name="Contrasena" id="Contrasena"
                                class="campoFormulario form-control" placeholder="Ingrese aquí la contraseña"
                                aria-label="Contrasena" autocomplete="off">
                            <div class="form-check form-switch" style="color: var(--rojo)">
                                <input class="form-check-input" type="checkbox" role="switch" id="checkVista">
                                <label id="vista" name="vista" class="form-check-label " for="checkVista">
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

                        <div>
                            <label for="Empleado">Empleado:</label>
                            <br>
                            <select name="Empleado" id="Empleado" class="campoFormulario form-select">
                                <option value="">Seleccione el Empleado</option>
                            </select>
                        </div>

                        <div class="">
                            <label for="conContrasena">Confirmar Contraseña:</label>
                            <input type="password" name="conContrasena" id="conContrasena"
                                class="campoFormulario form-control" placeholder="Ingrese de nuevo la contraseña"
                                aria-label="conContrasena" autocomplete="off">
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
                        <div>
                            <label for="Rol">Rol:</label>
                            <select id="Rol" name="Rol" class="campoFormulario form-select">
                                <option value="">Seleccione el Rol</option>
                                <option value="0">Usuario</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>
                        <br>

                        <input type="button" class="btn btn-success boton" name="Guardar" id="Guardar" value="Guardar">


                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="tabla table table-striped" id="tablaUsuarios" name="tablaUsuarios"></table>
</main>


<?php include "../include/templates/footer.php" ?>