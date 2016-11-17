<?php

namespace ImageMS\models\File\Information;

use ImageMS\models\File\File;
use ImageMS\models\Album\Album;
use ImageMS\models\Album\FileInformation\AlbumFileInformation;
use ImageMS\models\RoundSaveThumb\RoundSaveThumb;
use ImageMS\models\Thumbs\File\ThumbsFile;

/**
 * @author Emil Vililyaev
 */
trait FileInformationTableTrait
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_file_information';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                    => 'ID',
            'file_id'               => 'File ID',
            'name'                  => 'Name',
            'title'                 => 'Title',
            'description'           => 'Description',
            'ip'                    => 'Ip',
            'creator_model_name'    => 'Creator Model Name',
            'creator_object_id'     => 'Creator Object ID',
            'thumbs_category_id'    => 'Thumbs Category ID',
            'status'                => 'Status',
            'date_insert'           => 'Date Insert',
            'date_update'           => 'Date Update',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageAlbums()
    {
        return $this->hasMany(Album::className(), ['file_information_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageAlbum2fileInformations()
    {
        return $this->hasMany(AlbumFileInformation::className(), ['file_information_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(Album::className(), ['id' => 'album_id'])->viaTable('image_album2file_information', ['file_information_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::className(), ['id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageRoundSaveThumbs()
    {
        return $this->hasMany(RoundSaveThumb::className(), ['file_information_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageThumbs2files()
    {
        return $this->hasMany(ThumbsFile::className(), ['file_information_id' => 'id']);
    }

}