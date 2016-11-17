<?php

namespace ImageMS\models\Album\FileInformation;

use ImageMS\models\Album\Album;
use ImageMS\models\File\Information\FileInformation;

/**
 * @author Emil Vililyaev
 */
trait AlbumFileInformationTableTrait
{
    
 /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_album2file_information';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                    => 'ID',
            'album_id'              => 'Album ID',
            'file_information_id'   => 'File Information ID',
            'date_insert'           => 'Date Insert',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'album_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileInformation()
    {
        return $this->hasOne(FileInformation::className(), ['id' => 'file_information_id']);
    }
    
}