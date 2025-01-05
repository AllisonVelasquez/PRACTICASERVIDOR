<?php
require('../cargador.php');

include_once(__DIR__ . '/../view/header.php');

// Comprobamos si se envió el formulario
if (isset($_POST['registrarse'])) {
    // Recoger datos del formulario
    $nombreUsuario = $_POST['nombreUsuario'];
    $nombre = $_POST['nombre'];
    $email = $_POST['mail'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    //Comprobamos si el nombre de usuario ya esta registrado en la base de datos
    if(User::comprobarUser(User::getAll(),$nombreUsuario))
        $errores['usr'] = 'Nombre de usuario ya existente. Intenta con otro';

    if ($password1 !== $password2) {
        $errores['psw'] = 'Las contraseñas no coinciden.';
    }

    // Si hay errores, redirigir o mostrar mensaje
    if (isset($errores)) {
        
       include_once(__DIR__.'/../view/register.php');
        exit;

    } else {
        if(empty(User::getAll())){
        User::createUser($nombreUsuario, $nombre, $password1, $email,true);
        }
        else{
        User::createUser($nombreUsuario, $nombre, $password1, $email);
    }
    echo '<div class="alert alert-primary" role="alert">
        Usuario creado con exito. Puedes iniciar sesión <a href="../controller/controllerIndex.php?opcion=logIn"> AQUI.</a>
        </div>';

    }

} else {
    header('Location:../controller/controllerIndex.php');
    exit;
}
