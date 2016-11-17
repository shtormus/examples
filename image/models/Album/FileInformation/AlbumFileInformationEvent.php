<?php

namespace ImageMS\models\Album\FileInformation;

use yii\base\Behavior;
use app\models\System\Db\ActiveRecord;
use ImageMS\models\Album\FileInformation\AlbumFileInformation;
use ImageMS\models\Album\Album;

/**
 * @author Emil Vililyaev
 */
class AlbumFileInformationEvent extends Behavior
{

    /**
     * {@inheritDoc}
     * @see \yii\base\Behavior::events()
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
        ];
    }

    /**
     * @param mixed $event
     */
    public function beforeInsert($event)
    {
        /* @var $row AlbumFileInformation */
        $row = $event->sender;

        $objDateTime = new \DateTime('NOW');

        $row
            ->setDateInsert($objDateTime->format('Y-m-d H:i:s'))
        ;
    }

    /**
     * @param mixed $event
     */
    public function afterInsert($event)
    {
        /* @var $row AlbumFileInformation */
        $row = $event->sender;

        /* @var $album Album */
        $album = $row->getAlbum()->one();

        $fileInformationList = AlbumFileInformation::find()->where(['album_id' => $album->getId()])->all();

        if (!is_array($fileInformationList))
        {
            return;
        }

        $album
            ->setPhotoCount(count($fileInformationList))
            ->save()
        ;

    }

}