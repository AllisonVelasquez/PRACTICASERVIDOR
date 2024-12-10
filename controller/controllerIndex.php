<?php


if (isset($_GET['opcion'])) {
    $opcion = $_GET['opcion'];
    session_start();

    //Se guarda la opcion seleccionada para mantenerla activa en el nav del header
    $_SESSION['option'] = $opcion;

    require(__DIR__ . '/../view/header.php');
    switch ($opcion) {

        case 'logIn':

            include_once(__DIR__ . '/../controller/controllerLogIn.php');

            break;

        case 'registrarse':

            include_once(__DIR__ . '/../view/register.php');

            break;

        case 'logout':
            //elimina la cookie del usuario y redirige al login
            setcookie('usuario', '', time() - 10000);
            header('Location:./controllerLogIn.php');
            break;

        case 'libros':

            include_once(__DIR__ . '/../view/libros.php');

            break;

        case 'misPrestamos':

            include_once(__DIR__ . '/../view/misPrestamos.php');

            break;
        case 'gestionUsuarios':

            require_once(__DIR__ . '/../model/User.php');

            $users = User::getAll();

            include_once(__DIR__ . '/../view/gestionDeUsuarios.php');

            break;
        case 'miPerfil':

            include_once(__DIR__ . '/../view/miPerfil.php');

            break;

        case 'gestionarLibros':

            break;

        default:

            echo 'DEFAULT index controller';

            break;
    }
} else {
    require(__DIR__ . '/../view/header.php');
    require_once('../cargador.php');
    $books = Book::getAll();
    include_once(__DIR__ . '/../view/libros.php');
}
