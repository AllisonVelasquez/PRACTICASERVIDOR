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
            $prestamo = [
                'idUser' => $idUser,
                'idBook' => $idBook,
                'dateP' => time(),
                'dateD' => time() + 1296000,
                'devuelto' => false,
                'solicitudAmpliacion' => false,
            ];
            insert('checkouts', $prestamo);
            Book::prestar($idBook); //movido para que si falla no se pierda el libro igual
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    static function addDays($id, $cantidadDias = 7)
    {
        try {
            if (self::comprobarCheckout($id)) {

                $fecha = getDataById('checkouts', 'fechaD', $id);
                $fecha = new DateTime($fecha);
                $fecha->modify("+$cantidadDias days");
                updateDatabyParam('checkouts', ['fechaD' => $fecha->format('Y-m-d')], 'id', $id);
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
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
        try {
            return getAllByTable('checkouts');
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    static function comprobarCheckout($id)
    {
        try {
            return (!empty(getDataById('checkouts', 'id', $id)));
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    static function returnCheckout($id, $valor)
    {
        try {
            if (self::comprobarCheckout($id)) {
                $devolver = time();
                Book::devuelto($id);
                updateDatabyParam('checkouts', ['dateD' => $devolver], 'id', $id);

                return "Libro devuelto";
            }
            return "El préstamo $id no existe";
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    static function ampliar($id)
    {
        try {
            if (self::comprobarCheckout($id)) { //realmente es necesario el comprobarCheckout??
                updateDatabyParam('checkouts', ['solicitudAmpliacion' => 1], 'id', $id);
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
}
