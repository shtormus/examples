<?php

namespace ImageMS\models\Thumbs;


use ImageMS\models\Thumbs\Category\ThumbsCategory;
use ImageMS\models\Thumbs\File\ThumbsFile;
use ImageMS\models\File\File;

/**
 * @author Sergey Ivanov
 *
 */
trait ThumbsTableTrait
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_thumbs';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                => 'ID',
            'thumb_category_id' => 'Thumb Category ID',
            'name'              => 'Name',
            'width'             => 'Width',
            'heigth'            => 'Heigth',
            'description'       => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThumbCategory()
    {
        return $this->hasOne(ThumbsCategory::className(), ['id' => 'thumb_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThumbsFile()
    {
        return $this->hasMany(ThumbsFile::className(), ['thumbs_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['id' => 'file_id'])->viaTable('image_thumbs2file', ['thumbs_id' => 'id']);
    }
    
}