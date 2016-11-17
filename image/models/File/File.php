<?php

namespace ImageMS\models\File;

use Yii;
use app\models\System\Db\ActiveRecord;

/**
 * This is the model class for table "photo".
 *
 * @author Emil Vililyaev
 *
 * @property integer $id
 * @property integer $width
 * @property integer $heigth
 * @property string $file_path
 * @property integer $type
 * @property string $data_insert
 * @property string $server_name
 * 
 * @method \ImageMS\models\File\File setId()
 * @method \ImageMS\models\File\File setWidth()
 * @method \ImageMS\models\File\File setHeigth()
 * @method \ImageMS\models\File\File setFilePath()
 * @method \ImageMS\models\File\File setType()
 * @method \ImageMS\models\File\File setDataInsert()
 * @method \ImageMS\models\File\File setServerName()
 * 
 * @method integer  getId()
 * @method integer  getWidth()
 * @method integer  getHeigth()
 * @method string   getFilePath()
 * @method integer  getType()
 * @method string   getDataInsert()
 * @method string   getServerName()
 */
class File extends ActiveRecord
{
    
    use FileTableTrait;
    
}