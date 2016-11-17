<?php

namespace ImageMS;

use app\modules\services\components\MicroService;

/**
 * Photo module definition class
 */
class Module extends MicroService
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'ImageMS\controllers';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        \Yii::configure($this, require(__DIR__ . '/config/main.php'));

        // custom initialization code goes here
    }
}
