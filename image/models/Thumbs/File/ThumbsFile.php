<?php

namespace ImageMS\models\Thumbs\File;

use Yii;
use PhotoMS\models\Photo\Data\PhotoDataThumbsTableTrait;
use app\models\System\Db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "photo_data_thumbs".
 *
 * @author Sergey Ivanov
 *
 * @property integer $id
 * @property integer $file_id
 * @property integer $thumbs_id
 * @property string $file_path
 * @property integer $type
 * @property string $date_insert
 *
 * @method \ImageMS\models\Thumbs\File\ThumbsFile setId()
 * @method \ImageMS\models\Thumbs\File\ThumbsFile setFileInformationId()
 * @method \ImageMS\models\Thumbs\File\ThumbsFile setThumbsId()
 * @method \ImageMS\models\Thumbs\File\ThumbsFile setFilePath()
 * @method \ImageMS\models\Thumbs\File\ThumbsFile setType()
 * @method \ImageMS\models\Thumbs\File\ThumbsFile setDateInsert()
 *
 * @method integer      getId()
 * @method integer      getFileInformationId()
 * @method integer      getThumbsId()
 * @method string       getFilePath()
 * @method integer      getType()
 * @method string       getDateInsert()
 */
class ThumbsFile extends ActiveRecord
{

    use ThumbsFileTableTrait;

    /* (non-PHPdoc)
     * @see \app\models\System\Db\ActiveRecord::behaviors()
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_insert',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ]);
    }

}