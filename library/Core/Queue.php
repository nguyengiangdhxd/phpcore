<?php
namespace Core;

use Flywheel\Queue\Queue as QueueBase;


class Queue extends QueueBase
{
    const EMAIL_ERROR_ALERT = 'email_error';

    /**
     * Queue send email error
     *
     * @return QueueBase
     * @throws \Flywheel\Queue\Exception
     */
    public static function emailError()
    {
        return self::factory(self::EMAIL_ERROR_ALERT);
    }
}