<?php

namespace App\Services;

class MailService
{
    /**
     * @param string $emailTo
     * @param string $subject
     * @param string $message
     * @return bool
     */
    public static function send(
        string $emailTo,
        string $subject,
        string $message
    ): bool
    {
        // TODO Implement mail service, e.g. MailGun

        return true;
    }
}