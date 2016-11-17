<?php

namespace ImageMS\models\File\Information;

use app\models\System\SystemObjectData;
use ImageMS\models\File\form\UploadForm;
use app\modules\services\modules\HappyGiraffe\models\Member\Member;

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
 */
class FileInformationData extends SystemObjectData
{

    /**
     * @param UploadForm $form
     * @return \ImageMS\models\File\Information\FileInformationData
     */
    public function loadFromMemberForm(UploadForm $form)
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
         $this->ip = $request->getUserIP();

        return $this;
    }

}