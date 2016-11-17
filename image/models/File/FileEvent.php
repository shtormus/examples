<?php

namespace ImageMS\models\File;

use yii\base\Behavior;
use app\models\System\Db\ActiveRecord;

/**
 * @author Emil Vililyaev
 */
class FileEvent extends Behavior
{
    
    /* (non-PHPdoc)
     * @see \yii\base\Behavior::events()
     */
    public function events()
    {
       return [
           ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
       ]; 
    }
    
    /**
     * @param mixed $event
     */
    public function beforeInsert($event)
    {
        /* @var $row File */
        $row = $event->sender;   

        $objDateTime = new \DateTime('NOW');
        
        $row
            ->setDataInsert($objDateTime->format('Y-m-d H:i:s'))
        ;
    }
    
}