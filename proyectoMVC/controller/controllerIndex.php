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

            break;

        case 'misPrestamos':
            # code... redirigir al misPrestamos
            break;
        case 'gestionUsuarios':
            # code... redirigir al gestionUsuarios
            break;
        case 'gestionarUsuarios':
            # code... redirigir al gestionarUsuarios
            break;

        case 'gestionarLibros':
            # code... redirigir al gestionarLibros
            break;




        default:
            # code... redirrigir al principal
            break;
    }
} else {
    require_once(__DIR__ . '/../model/Book.php');
    $books = Book::getAll();
    include_once($ruta . '/../view/libros.php');
}
