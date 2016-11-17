<?php

namespace ImageMS\models\Album\FileInformation;

use app\models\System\Db\ActiveRecord;

/**
 * This is the model class for table "photo_album_data".
 *
 * @author Emil Vililyaev
 *
 * @property integer $id
 * @property integer $album_id
 * @property integer $photo_data_id
 * @property string $date_insert
 *
 * @method \ImageMS\models\Album\FileInformation\AlbumFileInformation setId()
 * @method \ImageMS\models\Album\FileInformation\AlbumFileInformation setAlbumId()
 * @method \ImageMS\models\Album\FileInformation\AlbumFileInformation setFileInformationId()
 * @method \ImageMS\models\Album\FileInformation\AlbumFileInformation setDateInsert()
 *
 * @method integer  getId()
 * @method integer  getAlbumId()
 * @method integer  getFileInformationId()
 * @method string   getDateInsert()
 */
class AlbumFileInformation extends ActiveRecord
{

    use AlbumFileInformationTableTrait;

}