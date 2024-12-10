<?php
// Comprobamos si se envió el formulario
include_once(__DIR__ . '/../view/header.php');

if (isset($_POST['registrarse'])) {
    // Recoger datos del formulario
    $nombreUsuario = $_POST['nombreUsuario'];
    $nombre = $_POST['nombre'];

    $email = $_POST['mail'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];


    if ($password1 !== $password2) {
        $errores[] = 'Las contraseñas no coinciden.';
    }

    // Si hay errores, redirigir o mostrar mensaje
    if (isset($errores)) {
       include_once(__DIR__.'/../view/register.php');
        exit;
    } else {
        require(__DIR__ . '/../model/User.php');
        User::createUser($nombreUsuario, $nombre, $password1, $email);
        echo 'Usuario creado';
        echo '<a href="../controller/controllerIndex.php?opcion=logIn">Iniciar sesion</a>';
    }

} else {
    header('Location:../controller/controllerIndex.php');
    exit;
}
