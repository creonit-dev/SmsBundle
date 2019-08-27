<?php


namespace Creonit\SmsBundle\Provider;


use Creonit\SmsBundle\Exception\SmsException;
use Creonit\SmsBundle\Message\SmsMessage;
use Symfony\Component\HttpFoundation\ParameterBag;
use Twig\Environment;

abstract class AbstractSmsProvider implements SmsProviderInterface
{
    /** @var Environment */
    protected $templating;

    /** @var ParameterBag */
    public $config;

    abstract function validateConfig(ParameterBag $config);

    public function createMessage($to, $template, $params = [])
    {
        $message = new SmsMessage($to);
        $message->setContent($this->renderTemplate($template, $params));

        return $message;
    }

    public function setTemplating(Environment $templating)
    {
        $this->templating = $templating;
    }

    protected function renderTemplate($template, $params = [])
    {
        return $this->templating->createTemplate($template)->render($params);
    }

    public function setConfig($config)
    {
        if (is_array($config)) {
            $config = new ParameterBag($config);
        } elseif (!$config instanceof ParameterBag) {
            throw new SmsException('Unknown config type');
        }

        $this->validateConfig($config);

        $this->config = $config;
    }
}