<?php
include_once(__DIR__ . '/../view/header.php');
require(__DIR__ . '/../controller/controllerIndex.php?opcion=gestionUsuarios');
if($_GET['blocked']){
User::setDato()
}elseif(!$_GET['blocked']){
    echo 'no';
}

?>