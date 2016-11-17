<?php

namespace ImageMS\models\RoundSaveThumb;

use yii\base\Behavior;
use app\models\System\Db\ActiveRecord;
use PhotoMS\models\RoundSaveThumb\Enum\Status;

/**
 * @author Sergey Ivanov
 */
class RoundSaveThumbEvent extends Behavior
{
    
    /* (non-PHPdoc)
     * @see \yii\base\Behavior::events()
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT   => 'beforeInsert',
        ];
    }
    
    public function beforeInsert($event)
    {
        /* @var $row RoundSaveThumb */
        $row = $event->sender;
    
        $objDateTime = new \DateTime('NOW');
    
        $row
            ->setDateInsert($objDateTime->format('Y-m-d H:i:s'))
        ;
        
    }
    
    
}