<?php
namespace yiicod\listener\components;

use yii\base\Event;

class DataEvent extends Event
{

    /**
     * Additional data for event
     * @var []
     */
    public $params = [];

}
