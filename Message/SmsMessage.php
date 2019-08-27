<?php

namespace Creonit\SmsBundle\Message;

class SmsMessage
{
    protected $to;
    protected $content;

    public function __construct($to = null)
    {
        if ($to) {
            $this->setTo($to);
        }
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param $to
     * @return $this
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
}