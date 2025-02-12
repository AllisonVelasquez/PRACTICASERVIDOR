<?php
//Controlador del login
require_once('../cargador.php');
if (!isset($_POST['login'])) {
    include_once('../view/logIn.php');
} else {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    session_start();
    if (($resultadoLogin = User::login($nombre, $password) === true)) {
        $_SESSION['usuario'] = $nombre;
        $_SESSION['admin'] = User::getDato($nombre, 'admin');
        echo $_SESSION['admin'];

        header('location: ../controller/controllerIndex.php?opcion=libros');
    } else {
        $error = 'El campo nombre o contraseña son incorrectos';
        include('../view/header.php');
        include('../view/logIn.php');
    }
}
