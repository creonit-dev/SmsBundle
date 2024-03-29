<?php

namespace Creonit\SmsBundle\Transport;

use Creonit\SmsBundle\Message\SmsMessage;
use Creonit\SmsBundle\Model\SmsLog;
use Creonit\SmsBundle\Transport\Error\SmsTransportError;
use Creonit\SmsBundle\Transport\Exception\InvalidConfigurationException;

class SmsTrafficTransport extends AbstractSmsTransport
{
    protected const BASE_URL = 'https://api.smstraffic.ru/multi.php';

    public function send(SmsMessage $message)
    {
        if (empty($message->getTo())) {
            $this->addError(new SmsTransportError("The recipient is not specified", ['content' => $message->getContent()]));
        }

        foreach ($message->getTo() as $phone) {
            try {
                $result = $this->sendMessage($message->getContent(), $phone->getNumber());
                $status = SmsLog::STATUS_SUCCESS;
            } catch (\Exception $e) {
                $result = $e->getMessage();
                $status = SmsLog::STATUS_ERROR;
            }

            $this->smsLogService->create($phone->getNumber(), $message->getContent(), $status, $result);
        }
    }

    protected function sendMessage(string $content, string $phone)
    {
        return file_get_contents($this->makeUrl($content, $phone));
    }

    protected function makeUrl(string $content, string $phone): string
    {
        $query = http_build_query([
            'rus' => $this->getParameter('rus', 5),
            'login' => $this->getParameter('login'),
            'password' => $this->getParameter('password'),
            'phones' => $phone,
            'message' => $content,
        ]);

        return sprintf('%s?%s', $this->getParameter('base_url', self::BASE_URL), $query);
    }

    protected function validateConfiguration(): void
    {
        $requiredFields = ['login', 'password'];

        if (!empty($undefinedFields = array_diff($requiredFields, array_keys($this->configuration->all())))) {
            throw new InvalidConfigurationException("Not defined parameters " . implode(', ', $undefinedFields));
        }
    }
}
