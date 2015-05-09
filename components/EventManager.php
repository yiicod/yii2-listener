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
    public $listenersAlias = '@app/config/listeners';

    /**
     *
     * @var type 
     */
    public $cacheId = 'cache';

    /**
     *
     * @var type 
     */
    public $cachingDuration = 0;

    /**
     * Init component
     */
    public function init()
    {
        parent::init();

//        $listeners = false;
//        if (false === is_null(Yii::$app->{$this->cacheId}) && $this->cachingDuration > 0) {
//            $listeners = Yii::$app->cache->get(trim(str_replace('\\', '_', __CLASS__), '_'));
//        }
//        if (false === $listeners) {
        $listeners = Yii::getAlias($this->listenersAlias) . '.php';
        if (!file_exists($listeners)) {
            throw new Exception($listeners . '.php file requered and must be return array!');
        }
        $listeners = include_once $listeners;
//            if (false === is_null(Yii::$app->{$this->cacheId})) {
//                Yii::$app->{$this->cacheId}->set(trim(str_replace('\\', '_', __CLASS__), '_'), $listeners, $this->cachingDuration);
//            }
//        }

        foreach ($listeners as $key => $listener) {
            $global = true;
            if (is_array($key)) {
                $global = false;
            }
            foreach ($listener as $objects) {
                if (true === is_array($objects) && false === is_object($objects[0]) && false === class_exists($objects[0])) {
                    $objects = function() use ($objects) {
                        $component = eval('return ' . $objects[0] . ';');
                        call_user_func_array(array($component, $objects[1]), func_get_args());
                    };
                }
                if ($global) {
                    Yii::$app->on($key, $objects);
                } else {
                    Event::on($key[0], $key[1], $objects);
                }
            }
        }
    }

}
