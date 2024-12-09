<?php
class Book
{
    private static $file = __DIR__ . '/../data/books.json';

    static function createBook($nombre, $cant, $autor, $gen, $desc)
    {
        $libros = self::getAll();

        $id = array_key_last($libros) + 1;

        $libros[$id] = [
            'nombre' => $nombre,
            'cant' => $cant,
            'autor' => $autor,
            'gen' => $gen,
            'desc' => $desc
        ];

        file_put_contents(self::$file, json_encode($libros));
    }

    static function setDato($id, $campo, $value)
    {
        $libros = self::getAll();
        if (self::comprobarId($id)) {
            $libros[$id][$campo] = $value;
            return "$campo modificado con éxito";
        }
        return "No hay ningún libro con el id $id";
    }

    static function getDato($id, $campo)
    {
        $libros = self::getAll();
        if (self::comprobarId($id))
            return $libros[$id][$campo];
        return "No hay ningún libro con el id $id";
    }

    static function delBook($id)
    {
        $libros = self::getAll();
        if (self::comprobarId($id)) {
            unset($libros[$id]);
            file_put_contents(self::$file, json_encode($libros));
            return true;
        }
        return false;
    }

    static function comprobarId($id)
    {
        $libros = self::getAll();
        return array_key_exists($id, $libros);
    }

    static function getAll()
    {
        if (file_exists(self::$file)) {
            return json_decode(file_get_contents(self::$file), true);
        }
        return [];
    }

    static function prestado($id)
    {
        $libros = self::getAll();
        if (self::comprobarId($id)) {
            $libros[$id]['cant'] -= 1;
            file_put_contents(self::$file, json_encode($libros));
            return true;
        }
        return false;
    }

    static function devuelto($id)
    {
        $libros = self::getAll();
        if (self::comprobarId($id)) {
            $libros[$id]['cant'] += 1;
            file_put_contents(self::$file, json_encode($libros));
            return true;
        }
        return false;
    }
}
