<?php

declare(strict_types=1);

namespace Creonit\SmsBundle\Service;

use Creonit\SmsBundle\Model\SmsLog;

class SmsLogService
{
    public function create(string $phone, string $content, int $status, string $response): SmsLog
    {
        $log = new SmsLog();
        $log
            ->setPhone($phone)
            ->setContent($content)
            ->setStatus($status)
            ->setResponse($response);

        $log->save();

        return $log;
    }
}
