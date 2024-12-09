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
            return 'Hacido';
        }
        return 'No hacido';
    }

    static function blockUser($user)
    {
        $users = self::getAll();
        if (isset($users[$user])) {
            if ($users[$user]['blocked'] == false) {
                $users[$user]['blocked'] = true;
                file_put_contents(self::$file, json_encode($users));
                return 'blokiado';
            }
            return 'Ya estaba blokiado bobo';
        }
        return 'noxiste';
    }


    static function unblockUser($user)
    {
        $users = self::getAll();
        if (isset($users[$user])) {
            if ($users[$user]['blocked'] == true) {
                $users[$user]['blocked'] = false;
                file_put_contents(self::$file, json_encode($users));
                return 'desblokiado';
            }
            return 'Ya estaba desblokiado bobo';
        }
        return 'noxiste';
    }

    static function modifyName($user, $campo, $valor)
    {
        $users = self::getAll();
        if (isset($users[$user])) {
            if ($campo == 'pass')
                $user[$user][$campo] = password_hash($valor, PASSWORD_DEFAULT);
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
        $user = array_search()
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
