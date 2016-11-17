<?php

namespace ImageMS\models\Thumbs\File;

use ImageMS\models\Thumbs\Thumbs;
use ImageMS\models\File\Information\FileInformation;

/**
 * @author Sergey Ivanov
 *
 */
trait ThumbsFileTableTrait
{

/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_thumbs2file';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                        => 'ID',
            'file_information_id'       => 'File Information ID',
            'thumbs_id'                 => 'Thumbs ID',
            'file_path'                 => 'File Path',
            'type'                      => 'Type',
            'date_insert'               => 'Date Insert',
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
    public function getThumbs()
    {
        return $this->hasOne(Thumbs::className(), ['id' => 'thumbs_id']);
    }

}