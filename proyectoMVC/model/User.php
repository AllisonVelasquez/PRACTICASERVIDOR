<?php
class User
{
    private static $file = __DIR__ . '/../data/users.json';

    static function createUser($nombre, $pass, $correo, $admin = false)
    {
        $users = self::getAll();
        //$id = array_key_last($users) + 1;

        $users[$id] = [
            'nombre' => $nombre,
            'pass' => password_hash($pass, PASSWORD_DEFAULT),
            'correo' => $correo,
            'admin' => $admin,
            'blocked' => false
        ];

        file_put_contents(self::$file, json_encode($users));
    }

    static function delUser($id)
    {
        $users = self::getAll();
        if (isset($users[$id])) {
            unset($users[$id]);
            file_put_contents(self::$file, json_encode($users));
            return 'Hacido';
        }
        return 'No hacido';
    }

    static function blockUser($id)
    {
        $users = self::getAll();
        if (isset($users[$id])) {
            if ($users[$id]['blocked'] == false) {
                $users[$id]['blocked'] = true;
                file_put_contents(self::$file, json_encode($users));
                return 'blokiado';
            }
            return 'Ya estaba blokiado bobo';
        }
        return 'noxiste';
    }


    static function unblockUser($id)
    {
        $users = self::getAll();
        if (isset($users[$id])) {
            if ($users[$id]['blocked'] == true) {
                $users[$id]['blocked'] = false;
                file_put_contents(self::$file, json_encode($users));
                return 'desblokiado';
            }
            return 'Ya estaba desblokiado bobo';
        }
        return 'noxiste';
    }

    static function modifyName($id, $campo, $valor)
    {
        $users = self::getAll();
        if (isset($users[$id])) {
            if ($campo == 'pass')
                $user[$id][$campo] = password_hash($valor, PASSWORD_DEFAULT);
        }
    }

    static function getAll()
    {
        if (file_exists(self::$file)) {
            return json_decode(file_get_contents(self::$file), true);
        }
        return [];
    }

    public static function login($name, $password)
    {
        $users = self::getAll();
        $id = array_search()
            if ($users['username'] === $username && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $username;
                return true;
            }
        }
        return false;
    }
}

// var_dump(User::getAll());
// echo User::blockUser(1) . '<br>';
// echo User::unblockUser(5) . '<br>';
// var_dump(User::getAll());
