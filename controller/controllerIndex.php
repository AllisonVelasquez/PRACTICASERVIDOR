<?php

$ruta = __DIR__;

if (isset($_GET['opcion']) && isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
    $opcion = $_GET['opcion'];

    switch ($opcion) {
        case 'logout':
            //elimina la cookie del usuario y redirige al login
            setcookie('usuario', '', time() - 10000);
            header('Location:./controllerLogIn.php');
            break;

        case 'libros':
            # code... redirigir al libros
            include_once(__DIR__ . '/../view/libros.php');

            break;

        case 'misPrestamos':
            # code... redirigir al misPrestamos
            break;
        case 'gestionUsuarios':
            require_once(__DIR__ . '/../model/User.php');
            $users = User::getAll();
            # code... redirigir al gestionUsuarios
            include_once(__DIR__ . '/../view/gestionDeUsuarios.php');
            break;
        case 'gestionarUsuarios':
            # code... redirigir al gestionarUsuarios
            break;

        case 'gestionarLibros':
            # code... redirigir al gestionarLibros
            break;




        default:
            # code... redirrigir al principal
            echo 'DEFAULT index controller';
            break;
    }
} else {
    if (isset($_GET['opcion'])) {
        if ($_GET['opcion'] === 'logIn') {
            include_once('../controller/controllerLogIn.php');
        } elseif ($_GET['opcion'] === 'registrarse') {
            include_once('../view/register.php');
        }
    } else {
        require_once(__DIR__ . '/../model/Book.php');
        $books = Book::getAll();
        include_once($ruta . '/../view/libros.php');
    }
}
