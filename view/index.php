<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <?php if (isset($_SESSION['usuario'])) {
            echo '<a href="../controller/controllerIndex.php?opcion=logOut">Cerrar Session </a>';
        } else {
            echo '<a href="../controller/controllerIndex.php?opcion=logIn">Iniciar Session </a>';
            echo '<a href="../controller/controllerIndex.php?opcion=registrarse"> Registrarme</a>';
        } ?>
    </header>

    <?php require_once(__DIR__ . '/../controller/controllerIndex.php'); ?>