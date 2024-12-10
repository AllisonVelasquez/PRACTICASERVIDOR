<?php
class Checkout
{
    private static $file = __DIR__ . '/../data/checkouts.json';

    static function createCheckout($idUser, $idBook)
    {
        $prestamos = self::getAll();

        $id = array_key_last($prestamos) + 1;

        $prestamos[$id] = [
            'idUser' => $idUser,
            'idBook' => $idBook,
            'dateP' => time(),
            'dateD' => time() + 1296000
        ];

        file_put_contents(self::$file, json_encode($prestamos));
    }

    // static function delCheckout($id)
    // {
    //     $prestamos = self::getAll();
    //     if (self::comprobarCheckout($id)) {
    //         unset($prestamos[$id]);
    //         file_put_contents(self::$file, json_encode($prestamos));
    //         return true;
    //     }
    //     return false;
    // }

    // static function addDays($id, $cantidadDias)
    // {
    //     $prestamos = self::getAll();
    //     if (self::comprobarCheckout($id)) {
    //         $prestamos[$id]['dateD'] += ($cantidadDias * 86400);
    //     }
    // }

    // static function getDato($id, $campo)
    // {
    //     $prestamos = self::getAll();
    //     if (self::comprobarCheckout($id))
    //         return $prestamos[$id][$campo];
    //     return "El préstamo $id no existe";
    // }

    static function getAll()
    {
        if (file_exists(self::$file)) {
            return json_decode(file_get_contents(self::$file), true);
        }
        return [];
    }

    // static function comprobarCheckout($id)
    // {
    //     $prestamos = self::getAll();
    //     return array_key_exists($id, $prestamos);
    // }
}
