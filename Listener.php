<?php

namespace yiicod\listener;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;
use yii\helpers\ArrayHelper;

/**
 * Class Listener
 *
 * @package yiicod\listener\components
 */
class Listener extends Component implements BootstrapInterface
{
    public $eventAliases = [
        '@app/config/listeners.php',
    ];

    /**
     * @var array
     */
    private static $_events;

    public function init()
    {
        parent::init();

        Yii::beginProfile('Assign-events', __METHOD__);
        $events = [];
        static::$_events = [];
        foreach ($this->eventAliases as $alias) {
            if (file_exists(Yii::getAlias($alias))) {
                $events = ArrayHelper::merge($events, include(Yii::getAlias($alias)));
            }
        }

        ksort($events);

        foreach ($events as $priority => $keys) {
            foreach ($keys as $event => $listeners) {
                foreach ($listeners as $handler) {
                    list($class, $name) = explode('@', $event);
                    if (false === self::hasHandler($class, $name, $handler)) {
                        static::$_events[$class][$name][] = $handler;
                        Event::on($class, $name, $handler);
                    }
                }
            }
        }

        Yii::endProfile('Assign-events', __METHOD__);
    }

    /**
     * Register events
     *
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        // Called in the init method
    }

    /**
     * Check event list if handler exists for class.
     *
     * @param $class
     * @param $name
     * @param $handler
     *
     * @return bool
     */
    public static function hasHandler(string $class, string $name, array $handler): bool
    {
        $result = array_filter((static::$_events[$class][$name] ?? []), function ($item) use ($handler) {
            $item = array_map(function ($value) {
                return trim($value, '\\');
            }, $item);
            $handler = array_map(function ($value) {
                return trim($value, '\\');
            }, $handler);

            return $item === $handler;
        });

        return count($result) > 0;
    }
}
