<?php
require_once("Book.php");
class Checkout
{

    private static $file = __DIR__ . '/../data/checkouts.json';

    static function createCheckout($idUser, $idBook)
    {
        $prestamos = self::getAll();
        if (empty($prestamos)) {
            $id = 1;
        } else {
            $id = array_key_last($prestamos) + 1;
        }
        $prestamos[$id] = [
            'idUser' => $idUser,
            'idBook' => $idBook,
            'dateP' => time(),
            'dateD' => time() + 1296000,
            'devuelto' => false,
            Book::prestado($idBook)

        ];
        file_put_contents(self::$file, json_encode($prestamos));
    }

    static function addDays($id, $cantidadDias)
    {
        $prestamos = self::getAll();
        if (self::comprobarCheckout($id)) {
            $prestamos[$id]['dateD'] += ($cantidadDias * 86400);
        }
    }

    static function getCheckout($id)
    {
        $prestamos = self::getAll();
        if (self::comprobarCheckout($id))
            return $prestamos[$id];
        return "El préstamo $id no existe";
    }

    static function getAll()
    {
        if (file_exists(self::$file)) {
            return json_decode(file_get_contents(self::$file), true);
        }
        return [];
    }

    static function comprobarCheckout($id)
    {
        $prestamos = self::getAll();
        return array_key_exists($id, $prestamos);
    }

    static function returnCheckout($id)
    {
        $prestamos = self::getAll();
        if (self::comprobarCheckout($id)) {
            $prestamos[$id]['devuelto'] = true;
            Book::devuelto($id);
            return "Libro devuelto";
        }
        return "El préstamo $id no existe";
    }
}

//revisar que un usu/libro exista?
//revisar que un usuario no pueda tener el mismo libro dos veces