<?php

namespace yiicod\listener\components;

use Yii;
use yii\base\Component;
use yii\base\Event;
use yii\base\Exception;

class EventManager extends Component
{

    /**
     * Listeners
     * @var array
     */
    public $listeners = [];

    /**
     * Init component
     */
    public function init()
    {
        parent::init();

        foreach ($this->listeners as $event => $listener) {
            if (is_callable($listener)) {
                // do nothing
            }
            else if (is_array($listener)) {
                foreach ($listener as $handler) {
                    if (is_array($handler)) {
                        if (false === is_object($handler[0]) && false === class_exists($handler[0])) {
                            $handler = function() use ($handler) {
                                $component = eval('return ' . $handler[0] . ';');
                                call_user_func_array(array($component, $handler[1]), func_get_args());
                            };
                        }
                    }
                }
            }
            $this->attachListener($event, $listener);
        }
    }

    private function attachListener($event, $listener)
    {
        if (!is_array($listener)) {
            $listener   = [$listener];
        }
        foreach ($listener as $handler) {
            if (is_array($event)) {
                $className  = $event[0];
                $eventName  = $event[1];
                Event::on($className, $eventName, $handler);
            } else {
                Yii::$app->on($event, $handler);
            }
        }
    }
}
