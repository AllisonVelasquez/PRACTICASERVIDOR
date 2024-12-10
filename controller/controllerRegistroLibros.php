<?php
if($_GET['blocked']){
    echo 'Blokeado';
}elseif(!$_GET['blocked']){
    echo 'no';
}

?>