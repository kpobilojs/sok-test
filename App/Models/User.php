<?php

namespace App\Models;

use Core\Model;
use PDO;

class User extends Model
{
    /**
     * @param string $username
     * @param string $password
     * @return array
     */
    public static function getByCredentials(string $username, string $password): array
    {
        $db = static::getDB();
        $stmt = $db->prepare("
            SELECT *
            FROM user
            WHERE username = :username AND
                password = :password
        ");
        $stmt->execute([
            'username' => $username,
            'password' => $password,
        ]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result) && array_key_exists(0, $result)) {
            return $result[0];
        }

        return [];
    }
}
