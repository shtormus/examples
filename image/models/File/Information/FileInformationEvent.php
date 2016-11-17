<?php

namespace ImageMS\models\File\Information;

use yii\base\Behavior;
use app\models\System\Db\ActiveRecord;
use ImageMS\models\File\Information\Enum\Status;

/**
 * @author Emil Vililyaev
 */
class FileInformationEvent extends Behavior
{

    /* (non-PHPdoc)
     * @see \yii\base\Behavior::events()
     */
    public function events()
    {
       return [
           ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
           ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
       ];
    }

    /**
     * @param mixed $event
     */
    public function beforeInsert($event)
    {
        /* @var $row FileInformation */
        $row = $event->sender;

        $objDateTime = new \DateTime('NOW');

        $row
            ->setDateInsert($objDateTime->format('Y-m-d H:i:s'))
            ->setStatus($row->getStatus() ?? Status::CREATED)
        ;
    }

    /**
     * @param mixed $event
     */
    public function beforeUpdate($event)
    {
        /* @var $row FileInformation */
        $row = $event->sender;

        $objDateTime = new \DateTime('NOW');

        $row
            ->setDateUpdate($objDateTime->format('Y-m-d H:i:s'))
        ;
    }

}