<?php

namespace ImageMS\models\Album\form;

use ImageMS\models\Album\AlbumManager;
use ImageMS\models\File\Information\FileInformationManager;
use app\models\System\SystemManager;
use app\models\System\ModelAbstract;
use app\models\System\SystemFormAbstract;
use app\models\System\DevelopDebug;

/**
 * @author Emil Vililyaev
 */
class AddToAlbum extends SystemFormAbstract
{

    /**
     * @var string
     */
    public $album_id;

    /**
     * @var string
     */
    public $file_information_id;

    //-----------------------------------------------------------------------------------------------------------

    /**
     * @param string $attribute
     * @param SystemManager $objManager
     */
    private function _isExistValidate($attribute, $objManager)
    {
        if (!$objManager->isExist($this->$attribute))
        {
            $this->addError($attribute, $attribute . ' not exist');
        }
    }

    //-----------------------------------------------------------------------------------------------------------

    /**
     * {@inheritDoc}
     * @see \app\models\System\ModelAbstract::rules()
     */
    public function rules()
    {
        return [
            [['file_information_id', 'album_id'], 'required'],
            ['album_id', 'validateAlbumId'],
            ['file_information_id', 'validateFileInformationId'],
        ];
    }

    /**
     * @param string $attribute
     */
    public function validateAlbumId($attribute)
    {
        $manager = new AlbumManager();
        $this->_isExistValidate($attribute, $manager);
    }

    /**
     * @param string $attribute
     */
    public function validateFileInformationId($attribute)
    {
        $manager = new FileInformationManager();
        $this->_isExistValidate($attribute, $manager);
    }

}