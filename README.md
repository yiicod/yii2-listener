Event listener
==============

If you want know what events do you have, install this extension and 
use file "listener" for add some events. You always will know
that event you have and that class has assigned

Installation
------------
```json
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/yiicod/yii2-listener.git"
    }  
],
```
Either run

```
php composer.phar require --prefer-dist yiicod/yii2-listener "*"
```

or add

```json
"yii2-listener": "*"
```

Config
------

```php
'bootstrap' => ['eventManager'],
'components' => [
        'eventManager' => [
            'class' => 'yiicod\listener\components\EventManager'
        ],
]
```
For trigger event use default manual http://www.yiiframework.com/doc-2.0/guide-concept-events.html
Global Events or Class-Level Event Handlers(Individual)

Example how you can trigger global event
----------------------------------------
 ```php

Yii::$app->trigger('app.controller.actionSignup.success', new yiicod\listener\components\DataEvent(new ExampleClass, ['key' => 'value']]));

```
If you want you can use default class Event. 


Example listener.php 
--------------------
 ```php
    return [
        //Individual event
        array(ActiveRecord::className(), ActiveRecord::EVENT_AFTER_INSERT) => [
            function ($event) {
                Yii::trace(get_class($event->sender) . ' is inserted');
            },
            ['Yii::$app->myComponent', 'helloWord'],
        ],
        //global event (like namespace)
        'app.controller.actionSignup.success' => [
            function ($event) {
                Yii::trace(get_class($event->sender) . ' is inserted');
            },
            ['Yii::$app->myComponent', 'helloWord'],
        ]
    ]
 ```
