<?php
class User
{
    private static $file = __DIR__ . '/../data/users.json';

    static function createUser($user, $nombre, $pass, $correo, $admin = false)
    {
        $users = self::getAll();

        $users[$user] = [
            'nombre' => $nombre,
            'pass' => password_hash($pass, PASSWORD_DEFAULT),
            'correo' => $correo,
            'admin' => $admin,
            'blocked' => false
        ];

        file_put_contents(self::$file, json_encode($users));
    }

    static function delUser($user)
    {
        $users = self::getAll();
        if (isset($users[$user])) {
            unset($users[$user]);
            file_put_contents(self::$file, json_encode($users));
            return true;
        }
        return false;
    }

    static function blockUser($user)
    {
        $users = self::getAll();
        if (isset($users[$user])) {
            if ($users[$user]['blocked'] == false) {
                $users[$user]['blocked'] = true;
                file_put_contents(self::$file, json_encode($users));
                return "Usuario bloqueado con éxito";
            }
            return "El usuario ya estaba bloqueado";
        }
        return "Nombre de usuario no existe";
    }


    static function unblockUser($user)
    {
        $users = self::getAll();
        if (isset($users[$user])) {
            if ($users[$user]['blocked'] == true) {
                $users[$user]['blocked'] = false;
                file_put_contents(self::$file, json_encode($users));
                return "Usuario desbloqueado con éxito";
            }
            return "El usuario no estaba bloqueado";
        }
        return "Nombre de usuario no existe";
    }

    static function setDato($user, $campo, $valor)
    {
        $users = self::getAll();
        if (self::comprobarUser($user)) {
            if ($campo == 'pass') {
                $users[$user][$campo] = password_hash($valor, PASSWORD_DEFAULT);
                return "Contraseña cambiada con éxito";
            } else {
                $users[$user][$campo] = $valor;
                return "$campo modificado con éxito";
            }
        }
        return "Usuario $user no existe";
    }

    static function getAll()
    {
        if (file_exists(self::$file)) {
            return json_decode(file_get_contents(self::$file), true);
        }
        return [];
    }

    static function comprobarUser($usu)
    {
        $users = self::getAll();
        return array_key_exists($usu, $users);
    }

    static function login($usu, $pass)
    {
        $users = self::getAll();
        if (self::comprobarUser($usu)) {
            if (password_verify($pass, $users[$usu]['pass']))
                return true;
            echo "Contraseña incorrecta";
            return false;
        }
        echo "Usuario no existe";
        return false;
    }
}
