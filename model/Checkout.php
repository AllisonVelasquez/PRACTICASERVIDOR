<?php
require_once(__DIR__ . '/CRUD.php');
require_once("Book.php");

class Checkout
{


    static function createCheckout($idUser, $idBook)
    {
            insert('checkouts',[
                'idUser' => $idUser,
                'idBook' => $idBook,
                'dateP' => Date('Y-m-d',time()),
                'dateD' => Date('Y-m-d',time() + 1296000),
                'devuelto' => 0,
                'solicitudAmpliacion' => 0,
            ] );        
    }

    static function addDays($id, $cantidadDias = 7)
    {
            if (self::comprobarCheckout($id)) {

                $fecha = getDataById('checkouts', 'fechaD', $id);
                $fecha = new DateTime($fecha);
                $fecha->modify("+$cantidadDias days");
                updateDatabyParam('checkouts', ['fechaD' => $fecha->format('Y-m-d')], 'id', $id);
            }
        
    }


    // static function getCheckout($id)
    // {
    //     s = self::getAll();
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

    static function returnCheckout($id, $valor)
    {
            if (self::comprobarCheckout($id)) {
                $devolver = time();
                Book::devuelto($id);
                updateDatabyParam('checkouts', ['dateD' => $devolver], 'id', $id);

                return "Libro devuelto";
            }
            return "El préstamo $id no existe";
        
    }

    static function ampliar($id)
    {
            if (self::comprobarCheckout($id)) { //realmente es necesario el comprobarCheckout??
                updateDatabyParam('checkouts', ['solicitudAmpliacion' => 1], 'id', $id);
            }
        
    }
}
