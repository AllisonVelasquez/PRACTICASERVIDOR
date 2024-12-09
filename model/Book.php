<?php
class Book
{
    private static $ID = 1;
    private $nombre, $cant, $autor, $gen, $desc;

    function __construct($nombre, $cant, $autor, $gen, $desc)
    {
        $this->nombre = $nombre;
        $this->cant = $cant;
        $this->autor = $autor;
        $this->gen = $gen;
        $this->desc = $desc;
        self::$ID++;
    }
}
