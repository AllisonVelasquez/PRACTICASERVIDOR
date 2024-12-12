<?php
//Controlador del login
require_once('../cargador.php');
if (!isset($_POST['login'])) {
    header('location: ../view/logIn.php');
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
        $_SESSION['errorLogin'] = $resultadoLogin;
        header('location: ../view/logIn.php');
    }
}
