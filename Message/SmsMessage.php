<?php

namespace Creonit\SmsBundle\Message;

use Creonit\SmsBundle\Mime\Phone;

class SmsMessage
{
    /**
     * @var Phone[]
     */
    protected $to = [];
    protected string $content;

    public function __construct(string $content = '')
    {
        $this->content = $content;
    }

    /**
     * @return Phone[]
     */
    public function getTo(): array
    {
        return $this->to;
    }

    /**
     * @param Phone|string ...$to
     *
     * @return $this
     */
    public function setTo(...$to): self
    {
        $this->to = [];
        foreach ($to as $phone) {
            $this->addTo($phone);
        }

        return $this;
    }

    public function addTo(...$to): self
    {
        foreach ($to as $phone) {
            if (is_string($phone)) {
                $phone = Phone::create($phone);
            }

            $this->to[] = $phone;
        }

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }
}
