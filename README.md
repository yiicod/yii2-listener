Event listener
==============

If you want know what extensions do you have, install this extension and 
use one file "lestener" for add something on events

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

Config ( This is all config for extensions )
---------------------------------------------

```php
'bootstrap' => ['eventManager'],
'components' => [
        'eventManager' => [
            'class' => 'yiicod\listener\components\EventManager'
        ],
]
```