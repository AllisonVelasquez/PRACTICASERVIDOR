<?php
require_once(__DIR__ . '/CRUD.php');
class User
{
    static function createUser($user, $nombre, $pass, $correo, $admin = 0)
    {


        insert('users', [
            'id' => $user,
            'nombre' => $nombre,
            'pass' => password_hash($pass, PASSWORD_DEFAULT),
            'correo' => $correo,
            'admin' => $admin,
            'blocked' => 0
        ]);
    }
    static function getAll()
    {
     $a=getAllByTable("users");
        return  $a;
    }
    static function delUser($user)
    {

        self::comprobarUser($user);
        deleteById('users', $user);
    }

    // static function blockUser($user)
    // {
    //     $users = self::getAll();
    //     if (self::comprobarUser($users, $user)) {
    //         if ($users[$user]['blocked'] == false) {
    //             $users[$user]['blocked'] = true;
    //             file_put_contents(self::$file, json_encode($users));
    //             return "Usuario bloqueado con éxito";
    //         }
    //         return "El usuario ya estaba bloqueado";
    //     }
    //     return "Nombre de usuario no existe";
    // }


    // static function unblockUser($user)
    // {
    //     $users = self::getAll();
    //     if (self::comprobarUser($users, $user)) {
    //         if ($users[$user]['blocked'] == true) {
    //             $users[$user]['blocked'] = false;
    //             file_put_contents(self::$file, json_encode($users));
    //             return "Usuario desbloqueado con éxito";
    //         }
    //         return "El usuario no estaba bloqueado";
    //     }
    //     return "Nombre de usuario no existe";
    // }

    //Asegurarnos de que siempre revise si es admin para cambiar admin y blocked
    static function setDato($user, $campo, $valor)
    {


        if (updateDatabyParam('users', [$campo => $valor], 'id', $user)) {
            return "$campo modificado con éxito";
        } else
            return "No hay ningún usuario con el id $user";
    }

    static function getDato($user, $campo)
    {
        return getDataById('users', $campo, $user);
    }
    static function comprobarUser($usu)
    {

        return (!empty(getDataById('users', 'id', $usu)));
    }

    static function login($usu, $pass)
    {

        if (self::comprobarUser($usu)) {
            $password = getDataById('users', 'pass', $usu)[0]['pass'];
            if (password_verify($pass, $password)) return true;
        }
        return false;
    }
}
