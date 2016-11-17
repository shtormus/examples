<?php

namespace ImageMS\models\File\Information;

use app\models\System\SystemManager;
use ImageMS\models\File\FileManager;
use ImageMS\models\File\form\UploadForm;
use yii\web\UploadedFile;
use ImageMS\models\RoundSaveThumb\RoundSaveThumbManager;
use ImageMS\models\Thumbs\Category\ThumbsCategoryManager;

/**
 * @author Emil Vililyaev
 */
class FileInformationManager extends SystemManager
{

    /**
     * @param FileInformationData $data
     * @return \ImageMS\models\File\Information\FileInformation
     */
    private function _add(FileInformationData $data) : FileInformation
    {
        $informationRow = new FileInformation();
        $informationRow
            ->setFileId($data->file_id)
            ->setName($data->name)
            ->setTitle($data->title)
            ->setDescription($data->description)
            ->setIp($data->ip)
            ->setThumbsCategoryId($data->thumbs_category_id)
            ->setCreatorModelName($data->creator_model_name)
            ->setCreatorObjectId($data->creator_object_id)
            ->save()
        ;

        return $informationRow;
    }

    /**
     * @param string $imageContent
     * @return \ImageMS\models\File\File
     */
    private function _addFileRow($imageContent)
    {
        $fileManager = new FileManager();

        return $fileManager->addIfNotExist($imageContent);
    }

    /**
     * @param integer $fileInformationId
     * @param integer $thumbsCategoryId
     */
    private function _createRoundSaveThumbs($fileInformationId, $thumbsCategoryId, $extraData)
    {
        $thumbsCategoryManager = new ThumbsCategoryManager();

        if (is_null($thumbsCategoryId) || !$thumbsCategoryManager->isExist($thumbsCategoryId))
        {
            return;
        }

        $roundSaveThumbsManager = new RoundSaveThumbManager();
        $roundSaveThumbsManager->add($fileInformationId, $thumbsCategoryId, $extraData);
    }

    //------------------------------------------------------------------------------------------------------------------------------------

    /**
     * @param FileInformationData $data
     * @param string $imageContent
     * @return \ImageMS\models\File\Information\FileInformation
     */
    public function uploadImage(FileInformationData $data, $imageContent, $extraData = null)
    {
        $fileRow = $this->_addFileRow($imageContent);
        $data->file_id = $fileRow->getId();

        $informationRow = $this->_add($data);
        $this->_createRoundSaveThumbs($informationRow->getId(), $informationRow->getThumbsCategoryId(), $extraData);

        return $informationRow;
    }

    /**
     * @param integer $id
     * @return boolean
     */
    public function isExist($id)
    {
        $row = FileInformation::findOne(['id' => $id]);

        return !is_null($row);
    }

    /**
     * @param integer $id
     * @param boolean $throwException
     * @throws \ErrorException
     * @return NULL | FileInformation
     */
    public function get($id, $throwException = true)
    {
        $row = FileInformation::findOne(['id' => $id]);

        if (is_null($row) && $throwException)
        {
            throw new \ErrorException('File information by id: ' . $id . ' not found');
        }

        return $row;
    }

}