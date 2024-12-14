<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <!-- Enlazar con el CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Barra de navegación -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- Logo o nombre del sitio -->
                <a class="navbar-brand" href="#"><?php
                                                    echo  isset($_SESSION['usuario']) ? 'Bienvenido ' . $_SESSION['usuario'] : 'Biblioteca';
                                                    ?></a>

                <!-- Botón para dispositivos móviles -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Elementos del menú -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <?php if (isset($_SESSION['usuario'])) { ?>

                            <!-- Menú para usuarios logueados -->
                            <!-- Para el admin -->
                            <li class="nav-item">
                                <?php if ($_SESSION['admin']) : ?>
                                    <a class="nav-link"
                                        href="../controller/controllerIndex.php?opcion=gestionUsuarios">Gestionar Usuarios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../controller/controllerIndex.php?opcion=verPrestamos">Ver
                                    Prestamos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../controller/controllerIndex.php?opcion=registroLibros">Registro
                                    Libros</a>
                            </li>
                        <?php endif; ?>
                        <!-- Para el resto de Usuarios -->
                        <li class="nav-item">
                            <a class="nav-link" href="../controller/controllerIndex.php?opcion=misPrestamos">Mis
                                Prestamos </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../controller/controllerIndex.php?opcion=logOut">Cerrar Sesión</a>
                        </li>

                        <?php } else if (isset($_GET['opcion']) && (($_GET['opcion'] === 'logIn') || ($_GET['opcion'] === 'registrarse'))) {
                            if (($_GET['opcion'] === 'logIn')) { ?>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="../controller/controllerIndex.php?opcion=registrarse">Registrarse</a>
                            </li>
                        <?php }
                            if (($_GET['opcion'] === 'registrarse')) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../controller/controllerIndex.php?opcion=logIn">Iniciar Sesión</a>
                            </li>
                        <?php } ?>

                        <li class="nav-item">
                            <a class="nav-link" href="../controller/controllerIndex.php">Inicio</a>
                        </li>

                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../controller/controllerIndex.php?opcion=logIn">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="../controller/controllerIndex.php?opcion=registrarse">Registrarme</a>
                        </li>
                    <?php } ?>


                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Enlazar con el JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>