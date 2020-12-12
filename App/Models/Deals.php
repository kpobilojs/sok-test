<?php

namespace App\Models;

use App\Services\MailService;
use Core\Model;
use PDO;

class Deals extends Model
{
    public const TYPE_JUNIOR = 1;
    public const TYPE_SENIOR = 2;

    public const TYPE_JUNIOR_EMAIL = 'junior@test.com';
    public const TYPE_SENIOR_EMAIL = 'senior@test.com';

    public const STATUS_ASK = 1;
    public const STATUS_OFFER = 2;

    /**
     * @param int $type
     * @param array $application
     */
    public static function create(int $type, array $application): void
    {
        $db = static::getDB();
        $db->exec("
            INSERT INTO deals (application_id, type, status)
            VALUES (" . $application['id'] . "," . $type . "," . self::STATUS_ASK . ")
        ");

        $email = self::TYPE_SENIOR_EMAIL;
        if ($type === self::TYPE_JUNIOR) {
            $email = self::TYPE_JUNIOR_EMAIL;
        }

        $message =
            'Email: ' . $application['email'] . PHP_EOL .
            'Amount: ' . $application['amount'] . PHP_EOL .
            'Created at: ' . $application['created'];

        MailService::send($email, 'New application', $message);
    }

    /**
     * @return array
     */
    public static function getExtendedList(): array
    {
        $db = static::getDB();
        $statement = $db->query("
            SELECT d.id as id,
                   a.id as application_id,
                   a.email,
                   a.amount,
                   d.type,
                   d.status,
                   a.created
            FROM deals d
                LEFT JOIN applications a on a.id = d.application_id
        ");

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function makeOffer(int $dealId): void
    {
        $db = static::getDB();
        $db->exec("
            UPDATE deals
            SET status = " . self::STATUS_OFFER . "
            WHERE id = " . $dealId
        );

        $statement = $db->query("
            SELECT a.email
            FROM deals d
                LEFT JOIN applications a on a.id = d.application_id
            WHERE d.id = " . $dealId
        );
        $email = $statement->fetch(PDO::FETCH_ASSOC)['email'];

        MailService::send($email, 'Offer for your application', 'Please see our offer');
    }
}
