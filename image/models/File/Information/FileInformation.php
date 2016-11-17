<?php

namespace ImageMS\models\File\Information;

use Yii;
use app\models\System\Db\ActiveRecord;

/**
 * @author Emil Vililyaev
 *
 * @property integer $id
 * @property integer $file_id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property integer $ip
 * @property string $creator_model_name
 * @property integer $creator_object_id
 * @property integer $thumbs_category_id
 * @property integer $status
 * @property string $date_insert
 * @property string $date_update
 *
 * @method \ImageMS\models\File\Information\FileInformation setId()
 * @method \ImageMS\models\File\Information\FileInformation setFileId()
 * @method \ImageMS\models\File\Information\FileInformation setName()
 * @method \ImageMS\models\File\Information\FileInformation setTitle()
 * @method \ImageMS\models\File\Information\FileInformation setDescription()
 * @method \ImageMS\models\File\Information\FileInformation setIp()
 * @method \ImageMS\models\File\Information\FileInformation setCreatorModelName()
 * @method \ImageMS\models\File\Information\FileInformation setCreatorObjectId()
 * @method \ImageMS\models\File\Information\FileInformation setThumbsCategoryId()
 * @method \ImageMS\models\File\Information\FileInformation setStatus()
 * @method \ImageMS\models\File\Information\FileInformation setDateInsert()
 * @method \ImageMS\models\File\Information\FileInformation setDateUpdate()
 * 
 * @method integer  getId()
 * @method integer  getFileId()
 * @method string   getName()
 * @method string   getTitle()
 * @method string   getDescription()
 * @method integer  getIp()
 * @method string   getCreatorModelName()
 * @method integer  getCreatorObjectId()
 * @method integer  getThumbsCategoryId()
 * @method integer  getStatus()
 * @method string   getDateInsert()
 * @method string   getDateUpdate()
 */
class FileInformation extends ActiveRecord
{
    
    use FileInformationTableTrait;
    
}