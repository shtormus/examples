<?php

namespace ImageMS\models\Album;

use app\models\System\SystemObjectData;
use ImageMS\models\Album\form\CreateAlbum;
use app\modules\services\modules\HappyGiraffe\models\Member\Member;

/**
 * @author Emil Vililyaev
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
 */
class AlbumData extends SystemObjectData
{

    /**
     * @param CreateAlbum $form
     * @return \ImageMS\models\Album\AlbumData
     */
    public function loadFromForm(CreateAlbum $form)
    {
        $arrAttr = $this->getObject()->getAttributes();

        foreach ($form->getAttributes() as $key => $value)
        {
            if (is_null($value) || !array_key_exists($key, $arrAttr))
            {
                continue;
            }

            $this->$key = $value;
        }

        /* @var $request \app\modules\services\components\GiraffeRequest */
        $request = \Yii::$app->request;
        $member = $request->getMember();

        $this->creator_model_name = $member->className();
        $this->creator_object_id = $member->getId();

        return $this;
    }

}