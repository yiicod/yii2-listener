<?php

namespace yiicod\listener\components\listeners;

use yii\base\Event;

abstract class ListenerAbstract implements ListenerInterface
{
    /**
     * @var Event
     */
    protected $event;

    /**
     * Call this on trigger event. Method should create object instance and call handle.
     *
     * @param Event $event
     */
    public static function on($event)
    {
        $class = get_called_class();
        $object = new $class($event);
        $object->handle($event);
    }

    /**
     * Return priority
     *
     * @return int
     */
    public static function priority(): int
    {
        return 10;
    }

    /**
     * Call on event method
     *
     * @param $event
     */
    abstract public function handle($event);
}
