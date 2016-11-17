<?php

namespace ImageMS\controllers;

use ImageMS\models\File\form\UploadForm;
use ImageMS\models\File\Information\FileInformationManager;
use yii\base\ErrorException;
use app\models\System\Controller\SystemControllerBase;

/**
 * @author Emil Vililyaev
 */
class ImageController extends SystemControllerBase
{

    /**
     * @param UploadForm $form
     * @param integer $thumbsCategoryId
     * @throws ErrorException
     * @return \ImageMS\models\File\Information\FileInformation
     */
    private function _uploadFromMemeberForm(UploadForm $form, $thumbsCategoryId = null)
    {
        $fileInformationManager = new FileInformationManager();

        /* @var $fileInformationData \ImageMS\models\File\Information\FileInformationData */
        $fileInformationData = $fileInformationManager->getObjectData();
        $fileInformationData->loadFromMemberForm($form);
        $fileInformationData->thumbs_category_id = $thumbsCategoryId;

        $fileInformationRow = $fileInformationManager->uploadImage($fileInformationData, $form->getImageContent());

        return $fileInformationRow;
    }

    /**
     * Загрузка картинок без Thumbs
     *
     * @example {"user": {"id": "1"},"data":{"base64Image":"base64content", "name":"image_name", "url":"if base64Image not passed", "title":"title", "description":"description"}}
     */
    public function actionUploadWithoutCategory()
    {
        /* @var $request \app\modules\services\components\GiraffeRequest */
        $request = \Yii::$app->request;

        $data = $request->getApiData();

        $form = new UploadForm();
        $form->setAttributes($data);

        if (!$form->validate())
        {
            return $this->renderJsonMessage($form->getErrors());
        }

        $fileInformationRow = $this->_uploadFromMemeberForm($form);

        return $this->renderJsonMessage($fileInformationRow);
    }

    /**
     * Загрузка картинок с последующим созданием Thumbs
     *
     * @example {"user": {"id": "1"},"data":{"base64Image":"base64content", "thumbsCategoryId":1, "name":"image_name", "url":"if base64Image not passed", "title":"title", "description":"description"}}
     */
    public function actionUploadWithCategory()
    {
        /* @var $request \app\modules\services\components\GiraffeRequest */
        $request = \Yii::$app->request;

        $data = $request->getApiData();

        $form = new UploadForm();
        $form->setScenario('withCategory');
        $form->setAttributes($data);

        if (!$form->validate())
        {
            return $this->renderJsonMessage($form->getErrors());
        }

        $fileInformationRow = $this->_uploadFromMemeberForm($form, $form->thumbsCategoryId);

        return $this->renderJsonMessage($fileInformationRow);
    }

}