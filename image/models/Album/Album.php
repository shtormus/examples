<?php

namespace ImageMS\models\Album;

use Yii;
use app\models\System\Db\ActiveRecord;

/**
 * @author Sergey Ivanov
 *
 * @property integer $id
 * @property integer $file_information_id
 * @property string $name
 * @property string $description
 * @property integer $photo_count
 * @property string $creator_model_name
 * @property integer $creator_object_id
 * @property integer $status
 * @property string $date_insert
 * @property string $date_update
 *
 * @method \ImageMS\models\Album\Album setId()
 * @method \ImageMS\models\Album\Album setFileInformationId()
 * @method \ImageMS\models\Album\Album setName()
 * @method \ImageMS\models\Album\Album setDescription()
 * @method \ImageMS\models\Album\Album setPhotoCount()
 * @method \ImageMS\models\Album\Album setCreatorModelName()
 * @method \ImageMS\models\Album\Album setCreatorObjectId()
 * @method \ImageMS\models\Album\Album setStatus()
 * @method \ImageMS\models\Album\Album setDateInsert()
 * @method \ImageMS\models\Album\Album setDateUpdate()
 *
 * @method integer      getId()
 * @method integer      getFileInformationId()
 * @method string       getName()
 * @method string       getDescription()
 * @method integer      getPhotoCount()
 * @method string       getCreatorModelName()
 * @method integer      getCreatorObjectId()
 * @method integer      getStatus()
 * @method string       getDateInsert()
 * @method string       getDateUpdate()
 *
 */
class Album extends ActiveRecord
{

    use AlbumTableTrait;

}