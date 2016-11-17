<?php

namespace ImageMS\controllers;

use app\models\System\Controller\SystemControllerBase;
use ImageMS\models\File\Information\FileInformationManager;
use ImageMS\models\File\Information\FileInformation;

/**
 * @author Sergey Ivanov
 */
class FileInformationController extends SystemControllerBase
{

    public function actionGet()
    {
        /* @var $request \app\modules\services\components\GiraffeRequest */
        $request = \Yii::$app->request;

        $fileInformationId = $request->getQueryParam('id');

        /**
         * @var FileInformation $rowFileInformation
         */
        $rowFileInformation = (new FileInformationManager)->get($fileInformationId, false);

        if (is_null($rowFileInformation))
        {
            \Yii::$app->response->setStatusCode(401, 'Validation fail');
            return $this->renderJsonMessage(['id' => 'IMAGE_NOT_EXISTS']);
        }

        return $this->renderJsonMessage($rowFileInformation);
    }

}