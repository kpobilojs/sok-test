<?php

namespace App\Models;

use Core\Model;
use PDO;

class Application extends Model
{
    /**
     * @param $email
     * @param $amount
     * @return array
     */
    public static function create($email, $amount): array
    {
        $db = static::getDB();
        $db->exec("
            INSERT INTO applications (email, amount)
            VALUES ('" . $email . "'," . $amount . ")
        ");
        $statement = $db->query("
            SELECT *
            FROM applications
            ORDER BY id DESC
            LIMIT 1;
        ");

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
