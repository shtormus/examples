<?php

namespace ImageMS\models\Thumbs;

use Yii;
use app\models\System\Db\ActiveRecord;

/**
 * This is the model class for table "photo_thumbs".
 * 
 * @author Sergey Ivanov
 *
 * @property integer $id
 * @property integer $thumb_category_id
 * @property string $name
 * @property integer $width
 * @property integer $heigth
 * @property string $description
 *
 * @method \PhotoMS\models\Thumbs\PhotoThumbs setId()
 * @method \PhotoMS\models\Thumbs\PhotoThumbs setThumbCategoryId()
 * @method \PhotoMS\models\Thumbs\PhotoThumbs setName()
 * @method \PhotoMS\models\Thumbs\PhotoThumbs setWidth()
 * @method \PhotoMS\models\Thumbs\PhotoThumbs setHeigth()
 * @method \PhotoMS\models\Thumbs\PhotoThumbs setDescription()
 *
 * @method integer      getId()
 * @method integer      getThumbCategoryId()
 * @method string       getName()
 * @method integer      getWidth()
 * @method integer      getHeigth()
 * @method string       getDescription()
 */
class Thumbs extends ActiveRecord
{
    
    use ThumbsTableTrait;
    
}