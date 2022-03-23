<?php

namespace Creonit\SmsBundle\Transport;

use Creonit\SmsBundle\Service\SmsLogService;
use Creonit\SmsBundle\Transport\Error\SmsTransportError;
use Creonit\SmsBundle\Transport\Exception\InvalidConfigurationException;

abstract class AbstractSmsTransport implements SmsTransportInterface
{
    protected SmsLogService $smsLogService;
    protected SmsTransportConfiguration $configuration;

    /**
     * @var SmsTransportError[]
     */
    protected $errors = [];

    public function __construct(SmsLogService $smsLogService)
    {
        $this->smsLogService = $smsLogService;
        $this->configuration = new SmsTransportConfiguration();
    }

    /**
     * @return SmsTransportError[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    protected function addError(SmsTransportError $error)
    {
        $this->errors[] = $error;
    }

    public function init(array $configuration): self
    {
        $this->configuration = new SmsTransportConfiguration($configuration);
        $this->validateConfiguration();

        return $this;
    }

    protected function getParameter(string $key, $default = null)
    {
        return $this->configuration->get($key, $default);
    }

    protected function getRequiredParameter(string $key)
    {
        $value = $this->configuration->get($key);

        if (null === $value) {
            throw new InvalidConfigurationException("Not defined parameter $key");
        }

        return $value;
    }

    abstract protected function validateConfiguration();
}
