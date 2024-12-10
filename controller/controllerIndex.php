<?php
session_start();
require(__DIR__ . '/../view/header.php');
require_once(__DIR__ . '/../model/Book.php');
if (isset($_GET['opcion'])) {
    $opcion = $_GET['opcion'];

    /* si el usuario se ha logueado tiene acceso a estas paginas */
    if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
        require(__DIR__ . '/../model/Checkout.php');
        require_once(__DIR__ . '/../model/User.php');

        switch ($opcion) {
            case 'logOut':
                //elimina la cookie del usuario y redirige al login
                setcookie('preferencias', '', time() - 10000);
                include_once(__DIR__ . '/../view/logOut.php');
                break;

            case 'libros':
                # code... redirigir al libros
                include_once(__DIR__ . '/../view/libros.php');

                break;

            case 'misPrestamos':
                $prestamos = Checkout::getAll();
                # code... redirigir al misPrestamos
                include_once(__DIR__ . '/../view/misPrestamos.php');
                break;
            case 'gestionUsuarios':
                $users = User::getAll();
                # code... redirigir al gestionUsuarios
                include_once(__DIR__ . '/../view/gestionDeUsuarios.php');
                break;
            case 'verPrestamos':
                # code... redirigir al gestionarUsuarios
                $prestamos = Checkout::getAll();
                # code... redirigir al misPrestamos
                include_once(__DIR__ . '/../view/verPrestamos.php');
                break;

            case 'registroLibros':
                # code... redirigir al gestionarLibros
                include_once(__DIR__ . '/../view/registroLibros.php');

                break;


        }
    }
    /* En caso de que el usuario no este logueado solo tendra acceso libre a estas paginas */ else if (!isset($_SESSION['usuario'])) {
        switch ($opcion) {
            case 'logIn':
                include_once(__DIR__ . '/../controller/controllerLogIn.php');
                break;

            case 'registrarse':
                include_once(__DIR__ . '/../view/register.php');
                break;

        }
    }
} else {
    $books = Book::getAll();
    include_once(__DIR__ . '/../view/libros.php');
}

if (isset($_GET['prestar'])) {
    require_once(__DIR__ . '/../model/Checkout.php');

    Checkout::createCheckout($_SESSION['usuario']['nombreUsu'], $_GET['prestar']);
    header('Location: ./controllerIndex.php?opcion=misLibros');
    exit;
}
