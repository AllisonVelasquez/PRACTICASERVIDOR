<?php
class Book
{
    private static $ID = 1;
    private $nombre, $cant, $autor, $gen, $desc;
    private static $file = __DIR__ . '/../data/books.json';

    function __construct($nombre, $cant, $autor, $gen, $desc)
    {
        $this->nombre = $nombre;
        $this->cant = $cant;
        $this->autor = $autor;
        $this->gen = $gen;
        $this->desc = $desc;
        self::$ID++;
    }
    static function getAll()
    {
        if (file_exists(self::$file)) {
            return json_decode(file_get_contents(self::$file), true);
        }
        return [];
    }
}
