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
"yiicod/listener": "*"
```

Config ( This is all config for extension )
-------------------------------------------

```php
'bootstrap' => ['eventManager'],
'components' => [
        'eventManager' => [
            'class' => 'yiicod\listener\components\EventManager'
        ],
]
```