<?php

namespace yiicod\listener\components\subscribers;

interface SubscriberInterface
{
    /**
     * @return array
     * [
     *      'event_class@event1' => 'on',
     *      'event_class@event2' => 'on'
     * ]
     */
    public static function subscribe(): array;

    /**
     * Return priority
     *
     * @return int
     */
    public static function priority(): int;
}
