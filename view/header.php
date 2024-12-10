<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header>

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="../controller/controllerIndex.php?opcion=libros"><i class="bi bi-house-fill"></i></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav w-100">
                        <?php

                        if (isset($_SESSION['usuario'])) { //si podeños añadirle el campo de admin true o false para mostrar en el nav las otras opciones del admin
                            echo '<li><a class="nav-link ' . ($_SESSION['option'] == 'misPrestamos' ? 'active' : '') . '" href="../controller/controllerIndex.php?opcion=misPrestamos">Mis Prestamos </a></li>';
                            echo '<li><a class="nav-link ' . ($_SESSION['option'] == 'miPerfil' ? 'active' : '') . '" href="../controller/controllerIndex.php?opcion=miPerfil">Perfil </a></li>';
                            echo '<li class="ms-auto"><a class="nav-link ' . ($_SESSION['option'] == 'logOut' ? 'active' : '') . '" href="../controller/controllerIndex.php?opcion=logOut">Cerrar Session </a></li>';
                        } else {

                            echo '<li><a class="nav-link ' . ($_SESSION['option'] == 'logIn' ? 'active' : '') . '" href="../controller/controllerIndex.php?opcion=logIn">Iniciar Sesion </a></li>';
                            echo '<li><a class="nav-link ' . ($_SESSION['option'] == 'registrarse' ? 'active' : '') . '" href="../controller/controllerIndex.php?opcion=registrarse"> Registrarme</a></li>';
                        }

                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>