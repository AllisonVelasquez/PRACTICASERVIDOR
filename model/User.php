<?php
require(__DIR__ . '/CRUD.php');
class User
{
    static function createUser($user, $nombre, $pass, $correo, $admin = false)
    {
        try {
            $usuario = [
                'id' => $user,
                'nombre' => $nombre,
                'pass' => password_hash($pass, PASSWORD_DEFAULT),
                'correo' => $correo,
                'admin' => $admin,
                'blocked' => false
            ];
            insert('users', $usuario);
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
    static function getAll()
    {
        try {
            return  getAllByTable("users");

        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
    static function delUser($user)
    {
        try {
            self::comprobarUser($user);
            deleteById('users', $user);
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
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
        try {

            if (updateDatabyParam('users', [$campo => $valor], 'id', $user)) {
                return "$campo modificado con éxito";
            } else
                return "No hay ningún usuario con el id $user";
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    static function getDato($user, $campo)
    {
        try {
            return getDataById('books', $campo, $user);
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
    static function comprobarUser($usu)
    {
        try {
            return (!empty(getDataById('users', 'id', $usu)));
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    static function login($usu, $pass)
    {

        if (self::comprobarUser($usu)) {
            $password = getDataById('users', 'pass', $usu);
            if (password_verify($pass, $password))
                return true;
        }
        return false;
    }
}
