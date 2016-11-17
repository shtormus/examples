<?php

namespace ImageMS\models\Album;

use yii\base\Behavior;
use app\models\System\Db\ActiveRecord;

/**
 * @author Emil Vililyaev
 */
class AlbumEvent extends Behavior
{

    /**
     * {@inheritDoc}
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
        /* @var $row Album */
        $row = $event->sender;

        $objDateTime = new \DateTime('NOW');

        $row
            ->setDateInsert($objDateTime->format('Y-m-d H:i:s'))
            ->setPhotoCount(0)
        ;
    }

    /**
     * @param mixed $event
     */
    public function beforeUpdate($event)
    {
        /* @var $row Album */
        $row = $event->sender;

        $objDateTime = new \DateTime('NOW');

        $row
            ->setDateUpdate($objDateTime->format('Y-m-d H:i:s'))
        ;
    }

}