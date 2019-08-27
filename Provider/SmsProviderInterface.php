<?php

namespace Creonit\SmsBundle\Provider;

use Creonit\SmsBundle\Message\SmsMessage;
use Symfony\Component\HttpFoundation\ParameterBag;
use Twig\Environment;

interface SmsProviderInterface
{
    /**
     * @param $to
     * @param $template
     * @param array $params
     * @return SmsMessage
     */
    public function createMessage($to, $template, $params = []);

    /**
     * @param SmsMessage $message
     * @return mixed
     */
    public function send(SmsMessage $message);

    /**
     * @param Environment $templating
     */
    public function setTemplating(Environment $templating);

    /**
     * @param ParameterBag|array $config
     */
    public function setConfig($config);
}