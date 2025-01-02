<?php
session_start();
require(__DIR__ . '/../view/header.php');
if (isset($_SESSION['usuario']) && isset($_SESSION['admin'])) {
    if (isset($_GET['accion'])) {
        if($_GET['accion']==='add'){
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
                $uploadFile = './../img/' . $guardarComo; // Crear nombre final

                if (!file_exists('./../img/')) {
                    //Si es el primer libro  que se crea y no existiera el archivo img lo creara 

                    mkdir('./../img/', 0777, true);
                }

                if (move_uploaded_file($tmpName, $uploadFile)) {
                    require(__DIR__ . '/../model/Book.php');
                    Book::createBook($nombre, $cantidad, $autor, $genero, $descripcion, $guardarComo);
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
        } else if ($_GET['accion'] === 'eliminar') {
        if(Book::delBook($id)){
            
        }
        }
    }
} else {
    header('location :' . __DIR__ . '/controllerIndex.php');
}