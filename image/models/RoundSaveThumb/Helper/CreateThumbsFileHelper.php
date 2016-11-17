<?php

namespace ImageMS\models\RoundSaveThumb\Helper;

use ImageMS\models\File\File;
use ImageMS\models\Thumbs\Category\ThumbsCategory;
use ImageMS\models\RoundSaveThumb\RoundSaveThumb;
use ImageMS\Module;
use ImageMS\models\Thumbs\File\ThumbsFileManager;
use ImageMS\models\Thumbs\File\ThumbsFileData;
use ImageMS\models\Thumbs\Thumbs;
use ImageMS\models\RoundSaveThumb\Enum\Status;
use ImageMS\models\RoundSaveThumb\RoundSaveThumbExtraData;
use app\models\System\DevelopDebug;
use ImageMS\models\File\Information\FileInformation;
use app\models\System\SystemImage;
use app\models\System\Image\SystemAdapterList;

/**
 * @author Emil Vililyaev
 */
class CreateThumbsFileHelper
{

    /**
     * @var RoundSaveThumb
     */
    private $_objRoundSaveThumb;

    /**
     * @var FileInformation
     */
    private $_objFileInformation;

    /**
     * @var File
     */
    private $_objFile;

    /**
     * @var ThumbsCategory
     */
    private $_objThumbsCategory;

    /**
     * @var string
     */
    private $_basePath;

    /**
     * @var string
     */
    private $_originalFilePath;

    /**
     * @var string
     */
    private $_fileExtention;

    /**
     * @var string
     */
    private $_thumbFileSaveDir;

    /**
     * @var ThumbsFileManager
     */
    private $_thumbFileManager;

    //------------------------------------------------------------------------------------------------------------------------------------

    /**
     * @param RoundSaveThumb $object
     */
    public function __construct(RoundSaveThumb $object)
    {
        $this->_objRoundSaveThumb = $object;
    }

    //------------------------------------------------------------------------------------------------------------------------------------

    /**
     * @return self
     */
    private function _preprocessing(SystemImage &$objImage)
    {
        if (is_null($this->_objRoundSaveThumb->getData()))
        {
            return $this;
        }

        /* @var $objData RoundSaveThumbExtraData */
        $objData = unserialize($this->_objRoundSaveThumb->getData());

        if (!($objData instanceof RoundSaveThumbExtraData))
        {
            return $this;
        }

        $objData
            ->init($objImage)
            ->process()
        ;

        return $this;
    }

    /**
     * @return \ImageMS\models\Thumbs\File\ThumbsFileManager
     */
    private function _getThumbsFileManager()
    {
        if (is_object($this->_thumbFileManager))
        {
            return $this->_thumbFileManager;
        }

        return new ThumbsFileManager();
    }

    /**
     * @return self
     */
    private function _setStatusError()
    {
        $this->_objRoundSaveThumb->setRoundStatus(Status::FAIL);

        return $this;
    }

    /**
     * @return self
     */
    private function _setStatusDone()
    {
        $this->_objRoundSaveThumb->setRoundStatus(Status::DONE);

        return $this;
    }

    /**
     * @return self
     */
    private function _setStatusProccess()
    {
        $this->_objRoundSaveThumb->setRoundStatus(Status::PROCESS);

        return $this;
    }

    /**
     * @param Thumbs $thumbs
     * @return string
     */
    private function _getThumbFilePath(Thumbs $thumbs)
    {
        return $this->_objFileInformation->getId() . '_' . $thumbs->getName() . $thumbs->getWidth() . 'x' . $thumbs->getHeigth() . $this->_fileExtention;
    }

    /**
     * @param Thumbs $thumbs
     * @return self
     */
    private function _createThumbsFile(Thumbs $thumbs)
    {
        $manager = $this->_getThumbsFileManager();

        /* @var $thumbFileData ThumbsFileData */
        $thumbFileData = $manager->getObjectData();

        $thumbFileData->file_information_id     = $this->_objFileInformation->getId();
        $thumbFileData->file_path               = $this->_thumbFileSaveDir . $this->_getThumbFilePath($thumbs);
        $thumbFileData->thumbs_id               = $thumbs->getId();
        $thumbFileData->type                    = $this->_objFile->getType();

        $row = $manager->add($thumbFileData);

        return $this;
    }

    /**
     * @param Thumbs $thumbs
     * @return self
     */
    private function _createThumbsImage(Thumbs $thumbs, SystemImage &$image)
    {
        $image->scaleImage($thumbs->getWidth(), $thumbs->getHeigth());

        $imagePath = $this->_basePath . $this->_thumbFileSaveDir . $this->_getThumbFilePath($thumbs);
        $image->writeImageToFile($imagePath);

        return $this;
    }

    /**
     * @return self
     */
    private function _createThumbs()
    {
        $thumbsList = $this->_getThumbsList();
        $objImage = new SystemImage();

        foreach ($thumbsList as /* @var $thumbs Thumbs */$thumbs)
        {
            $objImage->setImageFilePath($this->_basePath . $this->_originalFilePath);

            $this
                ->_preprocessing($objImage)
                ->_createThumbsImage($thumbs, $objImage)
                ->_createThumbsFile($thumbs)
            ;

            $objImage->clearAdapter();
        }

        return $this;
    }

    /**
     * @return self
     */
    private function _init()
    {
        $this->_objFileInformation              = $this->_objRoundSaveThumb->getFileInformation()->one();
        $this->_objFile                         = $this->_objFileInformation->getFile()->one();
        $this->_objThumbsCategory               = $this->_objRoundSaveThumb->getThumbsCategory()->one();
        $this->_basePath                        = Module::getInstance()->params['file']['BASE_DIR'];
        $this->_originalFilePath                = $this->_objFile->getFilePath();
        $this->_fileExtention                   = image_type_to_extension($this->_objFile->getType());

        $pattern = '#(.*\/)'. Module::getInstance()->params['file']['FILE_ORIGINAL_NAME'] . '\.#ui';

        preg_match($pattern, $this->_originalFilePath, $arrSaveDir);

        $this->_thumbFileSaveDir    = $arrSaveDir[1];

        return $this;
    }

    /**
     * @return multitype:\yii\db\ActiveRecord
     */
    private function _getThumbsList()
    {
        return $this->_objThumbsCategory->getImageThumbs()->all();
    }

    //------------------------------------------------------------------------------------------------------------------------------------

    /**
     * @return self
     */
    public function process()
    {
        try
        {
            $this
                ->_init()
                ->_setStatusProccess()
                ->_createThumbs()
                ->_setStatusDone()
            ;

        }
        catch (\Exception $e)
        {
           $this->_setStatusError();
           throw $e;
        }

        return true;

    }

}