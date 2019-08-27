<?php


namespace Creonit\SmsBundle;


use Creonit\SmsBundle\Message\SmsMessage;
use Creonit\SmsBundle\Provider\SmsProviderInterface;

class SmsManager
{
    /** @var SmsProviderInterface */
    protected $provider;

    public function __construct(SmsProviderInterface $provider, $providerConfig = [])
    {
        $provider->setConfig($providerConfig);
        $this->provider = $provider;
    }

    public function createMessage($to, $template, $params = [])
    {
        return $this->provider->createMessage($to, $template, $params);
    }

    public function send(SmsMessage $message)
    {
        $this->provider->send($message);
    }
}