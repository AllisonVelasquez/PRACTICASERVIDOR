<?php
require(__DIR__ . '/CRUD.php');
class Book
{

    static function createBook($nombre, $cant, $autor, $gen, $desc, $url, $habilidado = true)
    {
        try {
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
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    static function setDato($id, $campo, $value)
    {
        try {

            if (updateDatabyParam('books', [$campo => $value], 'id', $id)) {
                return "$campo modificado con éxito";
            } else
                return "No hay ningún libro con el id $id";
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
    static function getBook($id)
    {
        try {
            return getAllByParam('books', 'id', $id);
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
    static function getDato($id, $campo)
    {
        try {
            return getDataById('books', $campo, $id);
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    static function delBook($id)
    {
        try {
            deleteById('books', $id);
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    static function comprobarBook($id)
    {
        try {
            return (!empty(getDataById('books', 'id', $id)));
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    static function getAll()
    {
        try {
            return getAllByTable('books');
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    static function prestar($id)
    {
        try {
            $cant = getDataById('books', 'cantidad', $id);
            // revisar
            if (self::comprobarBook($id) && $cant > 0) {
                updateDatabyParam('books', ['cantidad' => $cant - 1], 'id', $id);
                return true;
            }
            return false;
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    static function devuelto($id)
    {
        try {
            $cant = getDataById('books', 'cantidad', $id);
            // revisar
            if (self::comprobarBook($id)) {
                updateDatabyParam('books', ['cantidad' => $cant + 1], 'id', $id);
                return true;
            }
            return false;
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
    static function deshabilitar($id)
    {
        try {
            if (self::comprobarBook($id)) {
                updateDatabyParam('books', ['habilitado' => 0], 'id', $id);
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    static function habilitar($id)
    {
        try {
            if (self::comprobarBook($id)) {
                updateDatabyParam('books', ['habilitado' => 1], 'id', $id);
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

}
