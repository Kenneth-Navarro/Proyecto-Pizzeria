<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzería Mabet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <!-- jQuery y SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


</head>

<script type="text/javascript" src="js/logueo.js"></script>

<body class="">
    <div class="fondo d-flex justify-content-center align-items-center">
        <div class="logueo">
            <h1 class="encabezadoLogueo">Pizzería Mabet</h1>
            <div class="cuerpoLogueo">
                <form>
                    <div class="margenesLogueo">
                        <label for="Usuario" class="form-label ">Usuario</label>
                        <input type="text" class="form-control campoLogueo" id="Usuario"
                            placeholder="Ingrese el nombre de usuario" autocomplete="off" required>
                    </div>
                    <div class="margenesLogueo">
                        <label for="Contrasena" class="form-label mt-5">Contraseña</label>
                        <div class="d-flex mb-3">
                            <input type="password" class="campoLogueo form-control" id="Contrasena"
                                placeholder="Ingrese la contraseña" autocomplete="off" required>
                            <button type="button" value="1" id="checkVista" style="background: none; border: none">
                                <svg class="eye verContrasenaLogueo" xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588M5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                    <path
                                        d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="text-center ">
                        <button type="submit" class="btn botonLogueo" id="Enviar">Iniciar Sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>