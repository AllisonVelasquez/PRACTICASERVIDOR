<?php
require_once(__DIR__ . '/CRUD.php');
class Book
{

    static function createBook($nombre, $cant, $autor, $gen, $desc, $url, $habilidado = true)
    {

        $libro = [
            'nombre' => $nombre,
            'cantidad' => $cant,
            'cantidadTotal' => $cant,
            'autor' => $autor,
            'genero' => $gen,
            'descripcion' => $desc,
            'url' => $url
        ];
        insert('books', $libro);
    }

    static function setDato($id, $campo, $value)
    {
        if (updateDatabyParam('books', [$campo => $value], 'id', $id)) {
            return "$campo modificado con éxito";
        } else
            return "No hay ningún libro con el id $id";
    }
    static function getBook($id)
    {
        return getAllByParam('books', 'id', $id);
    }
    static function getDato($id, $campo)
    {
        return getDataById('books', $campo, $id);
    }

    static function delBook($id)
    {
        deleteById('books', $id);
    }

    static function comprobarBook($id)
    {
        return (!empty(getDataById('books', 'id', $id)));
    }

    static function getAll()
    {
        return getAllByTable('books');
    }

    static function prestar($id)
    {
        $cant = getDataById('books', 'cantidad', $id)[0]['cantidad'];
        if (self::comprobarBook($id) && $cant > 0) {
            updateDatabyParam('books', ['cantidad' => $cant--], 'id', $id);
            return true;
        }
        return false;
    }

    static function devuelto($id)
    {
        $cant = getDataById('books', 'cantidad', $id)[0]['cantidad'];
        if (self::comprobarBook($id)) {
            updateDatabyParam('books', ['cantidad' => $cant++], 'id', $id);
            return true;
        }
        return false;
    }
    static function deshabilitar($id)
    {
        if (self::comprobarBook($id)) {
            updateDatabyParam('books', ['habilitado' => 0], 'id', $id);
        }
    }

    static function habilitar($id)
    {
        if (self::comprobarBook($id)) {
            updateDatabyParam('books', ['habilitado' => 1], 'id', $id);
        }
    }
}
