<?php

namespace ImageMS\models\Thumbs\Category;

use Yii;
use app\models\System\Db\ActiveRecord;

/**
 * This is the model class for table "photo_thumbs_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @method \PhotoMS\models\Thumbs\Category\PhotoThumbsCategory setId()
 * @method \PhotoMS\models\Thumbs\Category\PhotoThumbsCategory setName()
 * @method \PhotoMS\models\Thumbs\Category\PhotoThumbsCategory setDescription()
 *
 * @method integer      getId()
 * @method string       getName()
 * @method string       getDescription()
 */
class ThumbsCategory extends ActiveRecord
{

    use ThumbsCategoryTableTrait;
    
}