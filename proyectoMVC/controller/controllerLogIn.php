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
        //buscar el usuario y la contraseña en el json 
        //sacamos su id y nombre parab almacenarlo en la cookie

        //$usuarios= createUser();

        $_SESSION['usuario'] = $id;
        header('location:../controller/controllerIndex.php?opcion=libros');
        exit;
    } else {
        foreach ($errores as $key => $value) {
            # code...
            echo '<p style=color:red>' . $value . '</p>';
        }
        include('../view/logIn.php');
    }
} /* else if (isset($_GET['opcion'])) {
    if ($_GET['opcion'] === 'logIn') {
        header('location: ../view/logIn.php');
        exit;
}    } */
 else {
    //si el usuario es la primera vez que entra se muestra el formulario de login
    header('location: ../view/logIn.php');
    exit;
}
