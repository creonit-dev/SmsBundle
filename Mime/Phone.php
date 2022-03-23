<?php

namespace Creonit\SmsBundle\Mime;

class Phone
{
    protected string $name;
    protected string $number;

    public function __construct(string $number, string $name = '')
    {
        $this->number = $number;
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public static function create(string $number, string $name = ''): Phone
    {
        return new static($number, $name);
    }

    public function __toString()
    {
        $string = $this->number;

        if ($this->name) {
            $string .= " - {$this->name}";
        }

        return $string;
    }
}
