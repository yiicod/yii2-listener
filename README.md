Yii Event listener manager
==========================

[![Latest Stable Version](https://poser.pugx.org/yiicod/yii2-listener/v/stable)](https://packagist.org/packages/yiicod/yii2-listener) [![Total Downloads](https://poser.pugx.org/yiicod/yii2-listener/downloads)](https://packagist.org/packages/yiicod/yii2-listener) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yiicod/yii2-listener/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/yiicod/yii2-listener/?branch=master)[![Code Climate](https://codeclimate.com/github/yiicod/yii2-listener/badges/gpa.svg)](https://codeclimate.com/github/yiicod/yii2-listener)

Provides listener logic. 
Command parses chosen paths to find all listener/subscribers (depends on ListenerInterface and SubscriberInterface implementation).
Where listener can be used for single event and subscriber can be used for bunch of events.

#### Installation
Either run
```
php composer.phar require --prefer-dist yiicod/yii2-listener "*"
```

or add
```json
"yii2-listener": "*"
```
to your composer.json file

#### Web config 
```php
'bootstrap' => ['listener'],
'components' => [
    'listener' => [
        'class' => 'yiicod\listener\components\Listener'
    ],
]
```

#### Console config
```php
'controllerMap' => [
    'listener' => [
        'class' => \yiicod\listener\commands\Listener::class
    ],
]
```
Run command. This command will warm and prepare all listeners and subscriptions. Run this command each time when you create
new Listener or Subscription.
```bash
listener/parse
```

For trigger event use yii manual:
http://www.yiiframework.com/doc-2.0/guide-concept-events.html#class-level-event-handlers

#### Listener usage
 ```php
namespace frontend\observers\listeners;

use yii\db\ActiveRecord;
use yiicod\listener\components\listeners\ListenerAbstract;

class TestListener extends ListenerAbstract
{
    /**
     * Call on event method
     */
    public function handle($event)
    {
        // TODO: Implement handle() method.
    }

    /**
     * Return event name for emit
     * @return string
     */
    public static function event(): string
    {
        return ActiveRecord::class . '@' . ActiveRecord::EVENT_AFTER_FIND;
    }
}
 ```

#### Usage subscriber
 ```php
namespace frontend\observers\subscribers;

use yii\db\ActiveRecord;
use yiicod\listener\components\listeners\SubscriberAbstract;

class TestSubscriber extends SubscriberAbstract
{
    /**
     * @return array
     * [
     *      'event_class@event1' => 'on'
     *      'event_class@event2' => 'on'
     * ]
     */
    public static function subscribe(): array
    {
        return [
            ActiveRecord::class . '@' . ActiveRecord::EVENT_BEFORE_INSERT => 'on',
            ActiveRecord::class . '@' . ActiveRecord::EVENT_AFTER_INSERT => 'on'
        ];
    }

    /**
     * Call on event method
     */
    public function on($event)
    {
        // Handle
    }
}
 ```
