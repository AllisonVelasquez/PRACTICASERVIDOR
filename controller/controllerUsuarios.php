<?php
session_start();
require(__DIR__ . '/../cargador.php');
if (isset($_GET['blocked'])) {
    User::setDato($_GET['user'], 'blocked', (bool)$_GET['blocked']);
} else if (isset($_GET['admin'])) {
    User::setDato($_GET['user'], 'admin', (bool)$_GET['admin']);
}
header('Location: ../controller/controllerIndex.php?opcion=gestionUsuarios');
exit;
