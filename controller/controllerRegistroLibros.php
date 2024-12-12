<?php
session_start();
include_once(__DIR__ . '/../view/header.php');
if ($_GET['blocked']) {

} elseif (!$_GET['blocked']) {
    require(__DIR__.'/../model/User.php');
    User::setDato($_SESSION['usuario']['nombreUsu'],'bloked',true);
/*     require(__DIR__ . '/../controller/controllerIndex.php?opcion=gestionUsuarios');
 */
header('Location: ../controller/controllerIndex.php?opcion=gestionUsuarios');
exit;
}
