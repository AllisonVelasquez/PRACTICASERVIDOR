<?php
session_start();
require(__DIR__ . '/../view/header.php');
require('../cargador.php');

if (isset($_SESSION['usuario']) && isset($_SESSION['admin'])) {
    if (isset($_GET['accion'])) {
        if ($_GET['accion'] === 'add') {
            if (isset($_POST['addLibro'])) {
                // Recoger datos del formulario
                $nombre = $_POST['nombre'];
                $cantidad = $_POST['cantidad'];
                $autor = $_POST['autor'];
                $genero = $_POST['genero'];
                $descripcion = $_POST['descripcion'];

                /*
                comprueba que el achivo de la imagen existe y que no se ha producido errores al cargar la imagen
                algunos  return de $file[img][error]:
                    1=>la img excede el tamaño configurado en php.ini
                    2=>la img excede el tamaño especificado en el form
                    3=>el archivo se cargo parcialmente
                    4=>no se subio el archivo 
                */

                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
                    // Ruta temporal y directorio de destino
                    $tmpName = $_FILES['imagen']['tmp_name'];
                    $fileExtension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                    /* Sacamos los caracteres innecesarios que puedan ser pasados y guardamos el nombre del libro 
                    sustituyendo cualquier parametro que no entre en los parametros de filtrado sustituidos por un _
                    acepta letras tanto mayusculas como minusculas, numeros 0-9 y ( _ ) y (-)
                    */
                    $guardarComo = preg_replace('/[^A-Za-z0-9_\-]/', '_', $nombre) . '.' . $fileExtension;
                    $uploadFile = '../img/' . $guardarComo; // Crear nombre final
                    if (!file_exists('./../img/')) {
                        //Si es el primer libro  que se crea y no existiera el archivo img lo creara 

                        mkdir('../img/', 0777, true);
                    }

                    if (move_uploaded_file($tmpName, $uploadFile)) {
                        $img = str_replace('/', '\/', $uploadFile);

                        require(__DIR__ . '/../model/Book.php');
                        Book::createBook($nombre, $cantidad, $autor, $genero, $descripcion, $img);
                        echo "<h3 class='bg-primary'> $nombre registrado exitosamente</h3>";
                        include('./../view/RegistroLibros.php');
                    } else {
                        echo "<p>Error al subir la imagen.</p>";
                    }
                } else {
                    echo "<p>No se pudo cargar la imagen.</p>";
                }
            }
        } else if ($_GET['accion'] === 'modificar') {
            if (isset($_POST['modificarLibro'])) {
                if (!empty($_POST['nombre'])) {
                    Book::setDato($_POST['id'], 'nombre', $_POST['nombre']);
                }
                if (!empty($_POST['cantidad'])) {
                    Book::setDato($_POST['id'], 'cantidad', $_POST['cantidad']);
                }
                if (!empty($_POST['cantidadTotal'])) {
                    Book::setDato($_POST['id'], 'cantidadTotal', $_POST['cantidadTotal']);
                }
                if (!empty($_POST['autor'])) {
                    Book::setDato($_POST['id'], 'autor', $_POST['autor']);
                }
                if (!empty($_POST['genero'])) {
                    Book::setDato($_POST['id'], 'genero', $_POST['genero']);
                }
                if (!empty($_POST['descripcion'])) {
                    Book::setDato($_POST['id'], 'descripcion', $_POST['descripcion']);
                }
                if (!empty($_POST['imagen'])) {
                    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
                        // Ruta temporal y directorio de destino
                        $tmpName = $_FILES['imagen']['tmp_name'];
                        $fileExtension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                        /* Sacamos los caracteres innecesarios que puedan ser pasados y guardamos el nombre del libro 
                        sustituyendo cualquier parametro que no entre en los parametros de filtrado sustituidos por un _
                        acepta letras tanto mayusculas como minusculas, numeros 0-9 y ( _ ) y (-)
                        */
                        $guardarComo = preg_replace('/[^A-Za-z0-9_\-]/', '_', $nombre) . '.' . $fileExtension;
                        $uploadFile = '../img/' . Book::getDato($_POST['id'], 'nombre'); // Crear nombre final
                        if (move_uploaded_file($tmpName, $uploadFile)) {
                            $img = str_replace('/', '\/', $uploadFile);
                            Book::setDato($_POST['id'], 'url', $img);
                            echo "<h3 class='bg-primary'> $nombre modificado exitosamente</h3>";

                        } else {
                            echo "<p>Error al subir la imagen.</p>";
                        }
                    } else {
                        echo "<p>No se pudo cargar la imagen.</p>";
                    }
                }
            } else if (Book::comprobarBook($_GET['id'])) {
                $modificar = Book::getBook($_GET['id']);
                include_once('../view/RegistroLibros.php');
            } else {
                echo ' <h3>El libro no ha sido encontrado</h3>';
            }

        } else if ($_GET['accion'] === 'eliminar') {
            if (Book::delBook($id)) {

            }
        } else if ($_GET['accion'] === 'prestar') {
            require_once(__DIR__ . '/../model/Checkout.php');
            Checkout::createCheckout($_SESSION['usuario'], $_GET['id']);
            echo "<h3>Ha sacado el libro " . Book::getDato($_GET['id'], 'nombre') . "</h3>";
        }
    }
} else {
    header('location :' . __DIR__ . '/controllerIndex.php');
}