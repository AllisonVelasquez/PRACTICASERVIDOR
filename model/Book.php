<?php
require('./CRUD.php');
class Book
{
    private static $file = __DIR__ . '/../data/books.json';

    static function createBook($nombre, $cant, $autor, $gen, $desc, $url, $habilidado = true)
    {
        try {
            //code... 
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

        if (updateDatabyParam('books', [$campo => $value], 'id', $id) == true) {
            return "$campo modificado con éxito";
        }else return "No hay ningún libro con el id $id";
    }
    static function getBook($id)
    {
        return  getAllByParam('books','id',$id);
      
    }
    static function getDato($id, $campo)
    {
       return getDataById('books',$campo,$id);
    }

    static function delBook($id)
    {
        $libros = self::getAll();
        if (self::comprobarBook($id)) {
            unset($libros[$id]);
            file_put_contents(self::$file, json_encode($libros));
            return true;
        }
        return false;
    }

    static function comprobarBook($id)
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
        if (self::comprobarBook($id)) {
            $libros[$id]['cantidad'] -= 1;
            file_put_contents(self::$file, json_encode($libros));
            return true;
        }
        return false;
    }

    static function devuelto($id)
    {
        $libros = self::getAll();
        if (self::comprobarBook($id)) {
            $libros[$id]['cantidad'] += 1;
            file_put_contents(self::$file, json_encode($libros));
            return true;
        }
        return false;
    }
    static function deshabilitar($id)
    {
        $libros = self::getAll();
        if (self::comprobarBook($id)) {
            if ($libros[$id]['hablitado'] === true) {
                $libros[$id]['habilidato'] = false;
                file_put_contents(self::$file, json_encode($libros));
                return true;
            }
        }
        return false;
    }
    static function habilitar($id)
    {
        $libros = self::getAll();
        if (self::comprobarBook($id)) {
            if ($libros[$id]['hablitado'] === false) {
                $libros[$id]['habilidato'] = true;
                file_put_contents(self::$file, json_encode($libros));
                return true;
            }
        }
        return false;
    }
}
