<?php
//Controlador del login
/**
 * 
 */
$usuarios =
 [
    [
        "id" => 1,
        "activo" => true,
        "nombre" => "Juan",
        "password" => password_hash("password123", PASSWORD_DEFAULT),
        "blocked" => false,
        "correo" => "juan.perez@ejemplo.com"
    ],
    [
        "id" => 2,
        "activo" => false,
        "nombre" => "Ana García",
        "password" => password_hash("ana4567", PASSWORD_DEFAULT),
        "blocked" => true,
        "correo" => "ana.garcia@ejemplo.com"
    ],
    [
        "id" => 3,
        "activo" => true,
        "nombre" => "Carlos López",
        "password" => password_hash("carlos78", PASSWORD_DEFAULT),
        "blocked" => false,
        "correo" => "carlos.lopez@ejemplo.com"
    ],
    [
        "id" => 4,
        "activo" => true,
        "nombre" => "Laura Martínez",
        "password" => password_hash("laura3210", PASSWORD_DEFAULT),
        "blocked" => true,
        "correo" => "laura.martinez@ejemplo.com"
    ],
    [
        "id" => 5,
        "activo" => false,
        "nombre" => "Pedro Sánchez",
        "password" => password_hash("pedro9876", PASSWORD_DEFAULT),
        "blocked" => false,
        "correo" => "pedro.sanchez@ejemplo.com"
    ]
];

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
       foreach ($usuarios as $key => $value) {
        echo $value['nombre'];
    }
        $_SESSION['usuario'] = $id;
        header('location:../controller/controllerIndex.php');
        exit;
    }else{
        foreach ($errores as $key => $value) {
            # code...
            echo '<p style=color:red>'.$value .'</p>';
        }
        include('../view/logIn.php');

    }
} else if (isset($_GET['opcion'])) {

    header('location: ../view/register.php');
    exit;
} else {
    //si el usuario es la primera vez que entra se muestra el formulario de login
    header('location: ../view/logIn.php');
    exit;
}
