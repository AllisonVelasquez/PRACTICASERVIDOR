<?php
//Controlador del login
require_once('../view/index.php');
if (!isset($_POST['login'])) {
    header('location: ' . __DIR__ . '../view/logIn.php');
} else {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    session_start();
    $resultadoLogin = User::login($nombre, $password);
    if ($resultadoLogin == 'hecho') {
        $_SESSION['usuario'] = $nombre;
        header('location:' . __DIR__ . '../controller/controllerIndex.php?opcion=libros');
    } else
        echo $resultadoLogin;
}
