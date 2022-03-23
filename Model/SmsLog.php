<?php

namespace Creonit\SmsBundle\Model;

use Creonit\SmsBundle\Model\Base\SmsLog as BaseSmsLog;

/**
 * Skeleton subclass for representing a row from the 'sms_log' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class SmsLog extends BaseSmsLog
{
    public const STATUS_NEW = 0;
    public const STATUS_SUCCESS = 1;
    public const STATUS_ERROR = 2;

    public const STATUSES = [
        self::STATUS_NEW => 'Новая',
        self::STATUS_SUCCESS => 'Успешно',
        self::STATUS_ERROR => 'Ошибка',
    ];

    public function getStatusLabel(): string
    {
        return self::STATUSES[$this->getStatus()];
    }
}
