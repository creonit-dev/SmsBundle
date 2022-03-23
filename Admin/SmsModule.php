<?php

namespace Creonit\SmsBundle\Admin;

use Creonit\AdminBundle\Module;

class SmsModule extends Module
{
    protected function configure()
    {
        $this
            ->setTitle('СМС')
            ->setIcon('mobile')
            ->setTemplate('SmsLogTable');
    }

    public function initialize()
    {
        $this->addComponent(new SmsLogTable());
        $this->addComponent(new SmsLogEditor());
    }
}
