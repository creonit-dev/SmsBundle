<?php

namespace Creonit\SmsBundle\Mime;

class Phone
{
    protected $name;
    protected $number;

    public function __construct(string $number, string $name = '')
    {
        $this->number = $number;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    public static function create(string $number, string $name = '')
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
