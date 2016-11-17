<?php

namespace ImageMS\models\RoundSaveThumb;


use ImageMS\models\Thumbs\Category\ThumbsCategory;
use ImageMS\models\File\Information\FileInformation;

/**
 * @author Sergey Ivanov
 *
 */
trait RoundSaveThumbTableTrait
{

/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_round_save_thumb';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                                => 'ID',
            'file_information_id'               => 'File Information ID',
            'thumbs_category_id'                => 'Thumbs Category ID',
            'status'                            => 'Status',
            'date_insert'                       => 'Date Insert',
            'data'                              => 'Data',
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
    public function getThumbsCategory()
    {
        return $this->hasOne(ThumbsCategory::className(), ['id' => 'thumbs_category_id']);
    }

}