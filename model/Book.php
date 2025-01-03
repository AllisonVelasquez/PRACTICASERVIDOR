<?php
class Book
{
    private static $file = __DIR__ . '/../data/books.json';

    static function createBook($nombre, $cant, $autor, $gen, $desc, $url, $habilidado = true)
    {
        $libros = self::getAll();

        $id = array_key_last($libros) + 1;

        $libros[$id] = [
            'nombre' => $nombre,
            'cantidad' => $cant,
            'cantidadTotal' => $cant,
            'autor' => $autor,
            'genero' => $gen,
            'descripcion' => $desc,
            'url' => $url
        ];

        file_put_contents(self::$file, json_encode($libros));
    }

    static function setDato($id, $campo, $value)
    {
        $libros = self::getAll();
        if (self::comprobarBook($id)) {
            $libros[$id][$campo] = $value;
            return "$campo modificado con éxito";
        }
        return "No hay ningún libro con el id $id";
    }

    static function getDato($id, $campo)
    {
        $libros = self::getAll();
        if (self::comprobarBook($id))
            return $libros[$id][$campo];
        return "No hay ningún libro con el id $id";
    }

    static function delBook($id)
    {
        $libros = self::getAll();
        if (self::getDato($id, 'cantidad') === self::getDato($id, 'cantidadTotal')) {
            if (self::comprobarBook($id)) {
                unset($libros[$id]);
                file_put_contents(self::$file, json_encode($libros));
                return true;
            }

        } else {
            $libros[$id]['habilitado'] = false;
            file_put_contents(self::$file, json_encode($libros));
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
            if ($libros[$id]['hablitado'] === false) {
                self::delBook($id);
            }
            return true;
        }
        return false;
    }
}
