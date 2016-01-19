<?php

namespace yiicod\listener\components;

use Yii;
use yii\base\Component;
use yii\base\Event;
use yii\base\Exception;

class EventManager extends Component
{

    /**
     * Liastener php file
     * @var string
     */
    public $listeners = '@app/config/listeners';

    /**
     * Init component
     */
    public function init()
    {
        parent::init();

        if (is_string($this->listeners)) {
            $listeners = include_once Yii::getAlias($this->listeners) . '.php';
        } elseif (is_array($this->listeners)) {
            $listeners = $this->listeners;
        } else {
            throw new Exception('Create ' . $this->listeners . '.php file or set array, it is requered! $listeners have to get array!');
        }

        foreach ($listeners as $key => $listener) {
            foreach ($listener as $objects) {
                if (true === is_array($objects) && false === is_object($objects[0]) && false === class_exists($objects[0])) {
                    $objects = function() use ($objects) {
                        $component = eval('return ' . $objects[0] . ';');
                        call_user_func_array(array($component, $objects[1]), func_get_args());
                    };
                }
                if (!is_array($key)) {
                    //Global event
                    Yii::$app->on($key, $objects);
                } else {
                    Event::on($key[0], $key[1], $objects);
                }
            }
        }
    }

}
