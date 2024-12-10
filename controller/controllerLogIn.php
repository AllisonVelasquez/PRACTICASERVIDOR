<?php
//Controlador del login
require_once('../view/index.php');

if (isset($_POST["login"])) {
    if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
    } else {
        $errores['nombre'] = 'El campo nombre es obligatorio';
    }
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $errores['password'] = 'El campo password es obligatorio';
    }
    if (!isset($errores)) {
        session_start();
        if (User::login($nombre, $password)) {
            $_SESSION['usuario'] = [
                "nombreUsu" => $nombre,
                "admin" => User::getDato($nombre, campo: 'admin')
            ];
            header('location:../controller/controllerIndex.php?opcion=libros');
            exit;
        }
    } else {
        foreach ($errores as $key => $value) {
            # code...
            echo '<p style=color:red>' . $value . '</p>';
        }
        include_once('../view/logIn.php');
    }
} else {
    //si el usuario es la primera vez que entra se muestra el formulario de login
    include_once('../view/logIn.php');
    exit;
}
