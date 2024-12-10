<?php
include_once(__DIR__ . '/../view/header.php');
require(__DIR__ . '/../model/Book.php');

if (isset($_GET['opcion'])) {
    $opcion = $_GET['opcion'];

    /* si el usuario se ha logueado tiene acceso a estas paginas */
    if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
        require(__DIR__ . '/../model/Checkout.php');
        require_once(__DIR__ . '/../model/User.php');

        switch ($opcion) {
            case 'logout':
                //elimina la cookie del usuario y redirige al login
                setcookie('preferencias', '', time() - 10000);
                header('Location:./controllerLogIn.php');
                break;

            case 'libros':
                # code... redirigir al libros
                include(__DIR__ . '/../view/libros.php');

                break;

            case 'misPrestamos':
                $prestamos = Checkout::getAll();
                # code... redirigir al misPrestamos
                include(__DIR__ . '/../view/misPrestamos.php');
                break;
            case 'gestionUsuarios':
                $users = User::getAll();
                # code... redirigir al gestionUsuarios
                include(__DIR__ . '/../view/gestionDeUsuarios.php');
                break;
            case 'verPrestamos':
                # code... redirigir al gestionarUsuarios
                break;

            case 'registroLibros':
                # code... redirigir al gestionarLibros
                break;
            case 'gestionDeUsuarios':
                # code... redirigir al gestionarLibros
                break;

        }
    }
    /* En caso de que el usuario no este logueado solo tendra acceso libre a estas paginas */
    if (!isset($_SESSION['usuario'])) {
        switch ($opcion) {
            case 'logIn':
                include(__DIR__ . '/../controller/controllerLogIn.php');
                break;

            case 'registrarse':
                include(__DIR__ . '/../view/register.php');
                break;

        }
    }
}

else {
    $books = Book::getAll();
    include(__DIR__ . '/../view/libros.php');
}
