<?php

namespace ImageMS\controllers;

use app\models\System\Controller\SystemControllerBase;
use ImageMS\models\Thumbs\File\Form\ThumbsFileFormGet;
use ImageMS\models\Thumbs\File\ThumbsFileManager;

/**
 * @author Sergey Ivanov
 */
class ThumbsFileController extends SystemControllerBase
{

    /**
     * @return string
     *
     * @example {"data":{"categoryName": "userAvatar", "thumbsName":["small", "middle"], "fileInformationId" : 1}}
     */
    public function actionGet()
    {
        /* @var $request \app\modules\services\components\GiraffeRequest */
        $request = \Yii::$app->request;

        $data           = $request->getApiData();

        $form = new ThumbsFileFormGet();
        $form->setAttributes($data);

        if (!$form->validate())
        {
            \Yii::$app->response->setStatusCode(401, 'Validation fail');
            return $this->renderJsonMessage($form->getErrors());
        }

        $thumbsFileManager = new ThumbsFileManager();
        $thumbs = $thumbsFileManager->get($form->getCategoryRow()->getId(), $form->fileInformationId, $form->thumbsName);

        return $this->renderJsonMessage($thumbs);
    }

}