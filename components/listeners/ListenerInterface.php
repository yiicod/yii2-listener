<?php

namespace yiicod\listener\components\listeners;

use yii\base\Event;

interface ListenerInterface
{
    /**
     * Call this on trigger event. Method should create object instance and call handle.
     *
     * @param Event $event
     */
    public static function on($event);

    /**
     * Return priority
     *
     * @return int
     */
    public static function priority(): int;

    /**
     * Return event name for emit
     *
     * @return string
     */
    public static function event(): string;
}
