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
    static function getAll()
    {
        if (file_exists(self::$file)) {
            return json_decode(file_get_contents(self::$file), true);
        }
        return [];
    }
}
