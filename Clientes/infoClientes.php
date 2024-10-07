<?php include "../include/templates/header.php";
require_once "../DAL/clienteDAL.php";
require_once "../include/functions/recoge.php";

?>

<script type="text/javascript" src="../js/ControllerCliente/infoCliente.js"></script>

<main class="container">
    <ul class="nav margen">
        <li class="nav-item" style="margin-right: 2rem;">
            <a class=" navIndex" aria-current="page" href="../principal.php">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="activo navIndex" aria-current="page" href="">Clientes</a>
        </li>
    </ul>
    <button type="button" class="botonNuevo btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevo">
        <b>Nuevo Cliente <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg></b>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalNuevo" tabindex="-1" aria-labelledby="modalNuevo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered d-flex justify-content-center align-items-center ">
            <div class="modal-content modalConfig bordeModel">
                <div class="modal-header encabezadoNuevo">
                    <h2 class="textoEncabezadoModal modal-title text-center" id="encabezadoNew">Nuevo Cliente</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario dentro del modal -->

                    <form class="formularioModal">
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
                            <input type="text" name="PrimerApellido" id="PrimerApellido"
                                class="campoFormulario form-control" placeholder="Ingrese aquí el Primer Apellido"
                                aria-label="Primer Apellido" required>
                        </div>
                        <div class=" ">
                            <label for="SegundoApellido">Segundo Apellido:</label>
                            <input type="text" name="SegundoApellido" id="SegundoApellido"
                                class="campoFormulario form-control" placeholder="Ingrese aquí el Segundo Apellido"
                                aria-label="Segundo Apellido" required>
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
                            <textarea name="Direccion" placeholder="Ingrese aquí la dirección"
                                class="campoFormulario form-control" id="Direccion" cols="23" rows="10"
                                required></textarea>
                        </div>
                        <br>

                        <input type="button" class="btn btn-success boton" name="Guardar" id="Guardar" value="Guardar">


                    </form>
                </div>
            </div>
        </div>
    </div>


    <table class="tabla table table-striped" id="tablaClientes" name="tablaClientes"></table>

</main>
<?php include "../include/templates/footer.php" ?>