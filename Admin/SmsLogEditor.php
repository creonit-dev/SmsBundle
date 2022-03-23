<?php

declare(strict_types=1);

namespace Creonit\SmsBundle\Admin;

use Creonit\AdminBundle\Component\EditorComponent;
use Creonit\AdminBundle\Component\Request\ComponentRequest;
use Creonit\AdminBundle\Component\Response\ComponentResponse;

class SmsLogEditor extends EditorComponent
{
    /**
     * @title СМС
     * @entity Creonit\SmsBundle\Model\SmsLog
     *
     * @field status {load: 'entity.getStatusLabel()'}
     *
     * @template
     *
     * {% filter row %}
     *     {{ phone | panel | group('Телефон') | col(6) }}
     *     {{ status | panel | group('Статус') | col(6) }}
     * {% endfilter %}
     *
     * {{ content | textarea | group('Текст сообщения') }}
     * {{ response | textarea | group('Ответ') }}
     */
    public function schema()
    {

    }

    public function saveData(ComponentRequest $request, ComponentResponse $response)
    {

    }
}
