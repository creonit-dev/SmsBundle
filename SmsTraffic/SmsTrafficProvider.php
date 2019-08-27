<?php

namespace Creonit\SmsBundle\SmsTraffic;

use Creonit\SmsBundle\Exception\SmsException;
use Creonit\SmsBundle\Message\SmsMessage;
use Creonit\SmsBundle\Provider\AbstractSmsProvider;
use Symfony\Component\HttpFoundation\ParameterBag;

class SmsTrafficProvider extends AbstractSmsProvider
{
    public function send(SmsMessage $message)
    {
        if (!$to = $message->getTo()) {
            throw new SmsException('The recipient is not specified');
        }

        return file_get_contents($this->makeUrl($to, $message->getContent()));
    }

    protected function makeUrl($to, $content)
    {
        $query = http_build_query([
            'rus' => $this->config->get('rus', 5),
            'login' => $this->config->get('login'),
            'password' => $this->config->get('password'),
            'phones' => $to,
            'message' => urlencode($content),
        ]);

        return sprintf('%s?%s', $this->config->get('base_url'), $query);
    }

    function validateConfig(ParameterBag $config)
    {
        $requiredParams = ['base_url', 'login', 'password'];

        foreach ($requiredParams as $param) {
            if (!$config->has($param)) {
                throw  new SmsException("SmsTraffic. {$param} not specified");
            }
        }
    }


}