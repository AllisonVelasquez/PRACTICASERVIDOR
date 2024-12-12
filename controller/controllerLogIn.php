<?php

session_start();
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
        require(__DIR__ . '/../model/User.php');
        if (User::login($nombre, $password)) {

            $_SESSION['usuario'] = [
                "nombreUsu" => $nombre,
                "admin" => User::getDato($nombre,'admin')
            ];
            header('Location:../controller/controllerIndex.php');
            exit;
        }
    } else {
        foreach ($errores as $key => $value) {
            # code...
            echo '<p style=color:red>' . $value . '</p>';
        }
        include_once('../view/logIn.php');
        exit;
    }
} else {
    //si el usuario es la primera vez que entra se muestra el formulario de login
    include('../view/logIn.php');
    exit;
}
