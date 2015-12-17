<?php

namespace yiicod\listener\components\events;

use yii\base\Event;
use yii\base\Object;

class DataEvent extends Event
{
    /**
     * Additional data for event
     * @var []
     */
    public $params = [];

    /**
     * Constructor.
     * @param mixed $owner the object associated with this event.
     * @param array $config name-value pairs that will be used to initialize the object properties
     */
    public function __construct($config = [])
    {

        parent::__construct($config);
    }

}
