<?php
//Controlador del login
require_once('../cargador.php');
if (!isset($_POST['login'])) {
    include_once('../view/logIn.php');
} else {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    session_start();
    $resultadoLogin = User::login($nombre, $password);
    if ($resultadoLogin === true) {
        $_SESSION['usuario'] =$nombre;
        $_SESSION['admin']=User::getDato($nombre,'admin');

        header('location: ../controller/controllerIndex.php?opcion=libros');
    } else {
        include_once('../view/logIn.php');
    }
}
