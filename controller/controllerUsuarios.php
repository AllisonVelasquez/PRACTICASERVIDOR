<?php
session_start();
require(__DIR__ . '/../cargador.php');
if (isset($_GET['blocked'])) {
    if ($_GET['blocked']) {
        User::unblockUser($_GET['user']);
    } else {
        User::blockUser($_GET['user']);
    }
} else if (isset($_GET['admin'])) {

        User::setDato($_GET['user'], 'admin', $_GET['admin']);
    
}

// header('Location: ../controller/controllerIndex.php?opcion=gestionUsuarios');
// exit;
