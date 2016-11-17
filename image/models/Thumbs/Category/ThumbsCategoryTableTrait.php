<?php

namespace ImageMS\models\Thumbs\Category;


use ImageMS\models\RoundSaveThumb\RoundSaveThumb;
use ImageMS\models\Thumbs\Thumbs;

/**
 * @author sergey
 */
trait ThumbsCategoryTableTrait
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_thumbs_category';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'name'          => 'Name',
            'description'   => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageRoundSaveThumbs()
    {
        return $this->hasMany(RoundSaveThumb::className(), ['thumbs_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageThumbs()
    {
        return $this->hasMany(Thumbs::className(), ['thumb_category_id' => 'id']);
    }
}