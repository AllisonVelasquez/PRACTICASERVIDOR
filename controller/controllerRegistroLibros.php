<?php
session_start();
require(__DIR__ . '/../view/header.php');
require('../cargador.php');

// Definir constante para la carpeta de imágenes

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header('Location: controllerIndex.php');
    exit;
}

if (isset($_GET['accion'])) {
    // Verificar si el usuario es administrador
    $isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] === true;

    switch ($_GET['accion']) {
        case 'add':
            if ($isAdmin && isset($_POST['addLibro'])) {
                // Validar y recoger datos del formulario
                $nombre = htmlspecialchars($_POST['nombre'] ?? '');
                $cantidad = intval($_POST['cantidad'] ?? 0);
                $autor = htmlspecialchars($_POST['autor'] ?? '');
                $genero = htmlspecialchars($_POST['genero'] ?? '');
                $descripcion = htmlspecialchars($_POST['descripcion'] ?? '');

                // Manejo de subida de imágenes
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
                    $tmpName = $_FILES['imagen']['tmp_name'];
                    $fileExtension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                    $guardarComo = preg_replace('/[^A-Za-z0-9_\-]/', '_', $nombre) . '.' . $fileExtension;
                    $uploadFile = "../img/" . $guardarComo;

                    // Crear carpeta si no existe
                    if (!file_exists("../img/")) {
                        mkdir("../img/", 0777, true);
                    }

                    if (move_uploaded_file($tmpName, $uploadFile)) {
                        $img = str_replace('/', '\/', $uploadFile);
                        require(__DIR__ . '/../model/Book.php');
                        Book::createBook($nombre, $cantidad, $autor, $genero, $descripcion, $img);
                        echo "<h3 class='bg-primary'>$nombre registrado exitosamente</h3>";
                        include('../view/RegistroLibros.php');
                    } else {
                        echo "<p>Error al subir la imagen.</p>";
                    }
                } else {
                    echo "<p>No se pudo cargar la imagen.</p>";
                }
            }
            break;

        case 'modificar':
            if ($isAdmin && isset($_POST['modificarLibro']) && isset($_POST['id'])) {
                require(__DIR__ . '/../model/Book.php');

                $id = intval($_POST['id']);
                if (!empty($_POST['nombre']))
                    echo $_POST['nombre'];
                    Book::setDato($id, 'nombre', $_POST['nombre']);
                if (!empty($_POST['cantidad']))
                    Book::setDato($id, 'cantidad', intval($_POST['cantidad']));
                if (!empty($_POST['cantidadTotal']))
                    Book::setDato($id, 'cantidadTotal', intval($_POST['cantidadTotal']));
                if (!empty($_POST['autor']))
                    Book::setDato($id, 'autor', htmlspecialchars($_POST['autor']));
                if (!empty($_POST['genero']))
                    Book::setDato($id, 'genero', htmlspecialchars($_POST['genero']));
                if (!empty($_POST['descripcion']))
                    Book::setDato($id, 'descripcion', htmlspecialchars($_POST['descripcion']));

                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
                    $tmpName = $_FILES['imagen']['tmp_name'];
                    $fileExtension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                    $guardarComo = preg_replace('/[^A-Za-z0-9_\-]/', '_', htmlspecialchars($_POST['nombre'])) . '.' . $fileExtension;
                    $uploadFile = "../img/" . $guardarComo;
                    var_dump($_FILES['imagen']);
                    if (move_uploaded_file($tmpName, $uploadFile)) {
                        $img = str_replace('/', '\/', $uploadFile);
                        Book::setDato($id, 'url', $img);
                        echo "<h3 class='bg-primary'>Libro modificado exitosamente</h3>";
                    } else {
                        echo "<p>Error al subir la imagen.</p>";
                    }
                }
            } elseif (isset($_GET['id']) && Book::comprobarBook($_GET['id'])) {
                $modificar = Book::getBook($_GET['id']);
                include('../view/RegistroLibros.php');
            } else {
                echo '<h3>El libro no ha sido encontrado</h3>';
            }
            break;

        case 'eliminar':
            if ($isAdmin && isset($_GET['id'])) {
                $id = intval($_GET['id']);
                if (Book::delBook($id)) {
                    echo "<h3 class='bg-success'>Libro eliminado exitosamente</h3>";
                    header('Location: ' . $_SERVER['PHP_SELF']);
                    exit;
                } else {
                    echo "<p>Error al eliminar el libro.</p>";
                }
            }
            break;

        case 'prestar':
            if (isset($_GET['id'])) {
                require_once(__DIR__ . '/../model/Checkout.php');
                Checkout::createCheckout($_SESSION['usuario'], $_GET['id']);
                echo "<h3 class='bg-success'>Libro prestado exitosamente</h3>";
            }
            break;

        default:
            include(__DIR__ . '/../view/libros.php');
            break;
    }
}
?>