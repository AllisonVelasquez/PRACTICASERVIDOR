<?php
require(__DIR__ . '/CRUD.php');
require_once("Book.php");

class Checkout
{
/* **********************************************************************************
*
*
*    REVISAR: métodos comentados no se usan??, chequear las cosas comentadas        *
*
*
*
************************************************************************************/

    static function createCheckout($idUser, $idBook)
    {
        try {
            $prestamos = [
                'idUser' => $idUser,
                'idBook' => $idBook,
                'dateP' => time(),
                'dateD' => time() + 1296000,
                'devuelto' => false,
                'solicitudAmpliacion' => false,
            ];
            insert('checkouts', $prestamos);
            Book::prestar($idBook); //movido para que si falla no se pierda el libro igual
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    static function addDays($id, $cantidadDias = 7)
    {
        if (self::comprobarCheckout($id)) {
            $fecha = getDataById('checkouts', 'fechaD', $id) + $cantidadDias; //revisar, esto no funciona así
            updateDatabyParam('checkouts', $fecha , 'id', $id);
        }
    }

    // static function getCheckout($id)
    // {
    //     $prestamos = self::getAll();
    //     if (self::comprobarCheckout($id))
    //         return $prestamos[$id];
    //     return "El préstamo $id no existe";
    // }

    static function getAll()
    {
        return getAllByTable('checkouts');
    }

    static function comprobarCheckout($id)
    {
        return (!empty(getDataById('checkouts', 'id', $id)));
    }

    // static function returnCheckout($id, $valor)
    // {
    //     $prestamos = self::getAll();
    //     if (self::comprobarCheckout($id)) {
    //         // modifica la fecha al momento en que se devuelve el libro
    //         $prestamos[$id]['dateD'] = time();

    //         $prestamos[$id]['devuelto'] = $valor;
    //         Book::devuelto($id);
    //         file_put_contents(self::$file, json_encode($prestamos));

    //         return "Libro devuelto";
    //     }
    //     return "El préstamo $id no existe";
    // }

    static function ampliar($id)
    {
        //0 = false y 1 = true ?????
        if (self::comprobarCheckout($id)) { //realmente es necesario el comprobarCheckout??
            updateDatabyParam('checkouts', ['solicitudAmpliacion' => 1], 'id', $id);
        }
    }
}
