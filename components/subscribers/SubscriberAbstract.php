<?php

namespace yiicod\listener\components\subscribers;

use yii\base\Event;

abstract class SubscriberAbstract implements SubscriberInterface
{
    /**
     * @var Event
     */
    protected $event;

    /**
     * Return priority
     *
     * @return int
     */
    public static function priority(): int
    {
        return 10;
    }
}
