<?php 
include "../include/templates/header.php";
require_once "../DAL/proveedorDAL.php";
require_once "../include/functions/recoge.php";?>

<script type="text/javascript" src="../js/ControllerProveedor/infoProveedor.js"></script>
<script type="text/javascript" src="../js/ControllerProveedor/insertarProveedor.js"></script>


<main class="container">
<ul class="nav margen">
        <li class="nav-item margenNav">
            <a class=" navIndex" aria-current="page" href="../principal.php">Inicio</a>
        </li>
        <li class="nav-item margenNav">
            <a class=" navIndex activo" aria-current="page" href="">Proveedores</a>
        </li>
    </ul>
<button type="button" class="botonNuevo btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevo">
        <b>Nuevo Proveedor <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg></b>
    </button>
 <!-- Modal -->
 <div class="modal fade" id="modalNuevo" tabindex="-1" aria-labelledby="modalNuevo" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bordeModel">
                <div class="modal-header encabezadoNuevo">
                    <h2 class="textoEncabezadoModal modal-title text-center" id="encabezadoNew">Nuevo Proveedor</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario dentro del modal -->

                    <form class="formularioModal">
                        <div class="">
                            <label for="Nombre">Nombre:</label>
                            <input type="text" name="Nombre" id="Nombre" class="campoFormulario form-control"
                                placeholder="Ingrese aquí el nombre" aria-label="Nombre" required>
                        </div>

                        <div class="">
                            <label for="Encargado">Encargado:</label>
                            <input type="text" name="Encargado" id="Encargado" class="campoFormulario form-control"
                                placeholder="Ingrese aquí el encargado" aria-label="Encargado" required>
                        </div>

                        <div class="">
                            <label for="Telefono">Telefono:</label>
                            <input type="number" name="Telefono" id="Telefono" class="campoFormulario form-control"
                                placeholder="Ingrese aquí el telefono" aria-label="Telefono" required
                                >
                        </div>

                        <div class="">
                            <label for="Correo">Correo:</label>
                            <input type="text" name="Correo" id="Correo" class="campoFormulario form-control"
                                placeholder="Ingrese aquí el correo" aria-label="Correo" required>
                        </div>


                        <input type="button" class="btn btn-success boton" name="Guardar" id="Guardar" value="Guardar">


                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="tabla table table-striped" id="tablaProveedores" name="tablaProveedores"></table>
</main>


<?php include "../include/templates/footer.php" ?>