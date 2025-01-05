<?php
//Se vacia y destruye la sesion
session_unset();
session_destroy();

//Redireccion a la página de inicio.
header('Location:./../controller/controllerIndex.php');
exit;
?>