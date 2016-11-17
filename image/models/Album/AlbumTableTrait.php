<?php

namespace ImageMS\models\Album;


use ImageMS\models\File\Information\FileInformation;
use ImageMS\models\Album\FileInformation\AlbumFileInformation;

/**
 * @author Sergey Ivanov
 *
 */
trait AlbumTableTrait
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_album';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_information_id' => 'File Information ID',
            'name' => 'Name',
            'description' => 'Description',
            'photo_count' => 'Photo Count',
            'creator_model_name' => 'Creator Model Name',
            'creator_object_id' => 'Creator Object ID',
            'status' => 'Status',
            'date_insert' => 'Date Insert',
            'date_update' => 'Date Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileInformation()
    {
        return $this->hasOne(FileInformation::className(), ['id' => 'file_information_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageInAlbum()
    {
        return $this->hasMany(AlbumFileInformation::className(), ['album_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileInformations()
    {
        return $this->hasMany(FileInformation::className(), ['id' => 'file_information_id'])->viaTable('image_album2file_information', ['album_id' => 'id']);
    }
    
}