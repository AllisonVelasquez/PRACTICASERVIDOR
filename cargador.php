<?php
function autocarga($clase)
{
    require_once('model/' . $clase . '.php');
}

spl_autoload_register('autocarga');
