<?php

namespace ImageMS\models\RoundSaveThumb;

use Yii;
use app\models\System\Db\ActiveRecord;
use ImageMS\models\RoundSaveThumb\Enum\Status;

/**
 * @author Sergey Ivanov
 *
 * @property integer $id
 * @property integer $file_id
 * @property integer $thumbs_category_id
 * @property integer $status
 * @property string $date_insert
 *
 * @method \ImageMS\models\RoundSaveThumb\RoundSaveThumb setId()
 * @method \ImageMS\models\RoundSaveThumb\RoundSaveThumb setFileInformationId()
 * @method \ImageMS\models\RoundSaveThumb\RoundSaveThumb setThumbsCategoryId()
 * @method \ImageMS\models\RoundSaveThumb\RoundSaveThumb setStatus()
 * @method \ImageMS\models\RoundSaveThumb\RoundSaveThumb setDateInsert()
 * @method \ImageMS\models\RoundSaveThumb\RoundSaveThumb setData()
 *
 * @method integer      getId()
 * @method integer      getFileInformationId()
 * @method integer      getThumbsCategoryId()
 * @method integer      getStatus()
 * @method string       getDateInsert()
 * @method string       getData()
 *
 */
class RoundSaveThumb extends ActiveRecord
{

    use RoundSaveThumbTableTrait;

    /**
     * @param integer $status
     */
    public function setRoundStatus($status)
    {
        $enum = new Status();
        $enum->validate($status);

        $this
            ->setStatus($status)
            ->save()
        ;
    }

}