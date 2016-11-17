<?php

namespace ImageMS\models\Album\form;

use yii\base\Model;
use ImageMS\models\Album\AlbumManager;
use ImageMS\models\File\Information\FileInformationManager;
use app\models\System\SystemManager;
use app\models\System\DevelopDebug;
use app\models\System\SystemFormAbstract;

/**
 * @author Emil Vililyaev
 */
class PreviewToAlbum extends SystemFormAbstract
{

    /**
     * @var string
     */
    public $file_information_id;

    //-----------------------------------------------------------------------------------------------------------

    /* (non-PHPdoc)
     * @see \yii\base\Model::rules()
     */
    public function rules()
    {
        return [
            ['file_information_id', 'required'],
            ['file_information_id', 'validateFileInformationId'],
        ];
    }

    /**
     * @param string $attribute
     */
    public function validateFileInformationId($attribute)
    {
        $manager = new FileInformationManager();

        if (!$manager->isExist($this->$attribute))
        {
            $this->addError($attribute, $attribute . ' not exist');
        }
    }

}