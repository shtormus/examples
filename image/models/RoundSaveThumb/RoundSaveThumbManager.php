<?php

namespace ImageMS\models\RoundSaveThumb;

use app\models\System\SystemManager;
use ImageMS\models\RoundSaveThumb\Enum\Status;
use ImageMS\models\File\File;
use ImageMS\Module;
use ImageMS\models\Thumbs\Category\ThumbsCategory;
use ImageMS\models\Thumbs\Thumbs;
use ImageMS\models\Thumbs\File\ThumbsFileManager;
use ImageMS\models\Thumbs\File\ThumbsFileData;
use ImageMS\models\RoundSaveThumb\Helper\CreateThumbsFileHelper;
use app\models\System\DevelopDebug;
use app\models\System\Exception\SystemExceptionNull;

/**
 * @author Sergey Ivanov
 */
class RoundSaveThumbManager extends SystemManager
{

    /**
     * @param integer $fileInformationId
     * @param integer $thumbsCategoryId
     * @param array $data
     * @param integer $status
     * @return \ImageMS\models\RoundSaveThumb\RoundSaveThumb
     */
    public function add($fileInformationId, $thumbsCategoryId, $data = null, $status = null) : RoundSaveThumb
    {
        $row = new RoundSaveThumb();

        if (is_null($status))
        {
            $row->setStatus(Status::CREATED);
        }

        /* Пересмотреть перенос этой логики в объект с переопределением setData */
        if (is_array($data))
        {
            $objData = new RoundSaveThumbExtraData();
            $objData->loadData($data);
            $data = serialize($objData);
        }

        $row
            ->setFileInformationId($fileInformationId)
            ->setThumbsCategoryId($thumbsCategoryId)
            ->setData($data)
            ->save()
        ;

        return $row;
    }

    /**
     * @param integer $id
     * @param boolean $bThrowException
     * @return RoundSaveThumb | NULL
     */
    public function get($id, $bThrowException = TRUE)
    {
        $row = RoundSaveThumb::findOne($id);

        if ($bThrowException)
        {
            SystemExceptionNull::getInstance()->validate($row);
        }

        return $row;
    }

    /**
     * @param integer $fileInformationId
     * @param integer $thumbsCategoryId
     * @return RoundSaveThumb | NULL
     */
    public function getByInformationAndCategory($fileInformationId, $thumbsCategoryId)
    {
        return RoundSaveThumb::findOne(['thumbs_category_id' => $thumbsCategoryId, 'file_information_id' => $fileInformationId]);
    }

    /**
     * create thumbs for image process
     */
    public function process()
    {
        $roundList = RoundSaveThumb::find()->where(['status' => Status::CREATED])->all();

        foreach ($roundList as /* @var $roundObj RoundSaveThumb */$roundObj)
        {
            $createHelper = new CreateThumbsFileHelper($roundObj);
            $createHelper->process();
        }

        return true;
    }

}