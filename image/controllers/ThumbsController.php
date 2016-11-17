<?php

namespace ImageMS\controllers;

use ImageMS\models\Thumbs\form\CreateForm;
use ImageMS\models\Thumbs\ThumbsManager;
use app\models\System\Controller\SystemControllerBase;

/**
 * @author Emil Vililyaev
 */
class ThumbsController extends SystemControllerBase
{

    /**
     * create image thumbs
     *
     * @example {"user": {"id": "1"},"data":{"name":"", "width":"", "heigth":"", "description":"", "thumb_category_id":1}}
     */
    public function actionCreate()
    {
        /* @var $request \app\modules\services\components\GiraffeRequest */
        $request = \Yii::$app->request;

        $data = $request->getApiData();

        $form = new CreateForm();
        $form->setAttributes($data);

        if (!$form->validate())
        {
            return $this->renderJsonMessage($form->getErrors());
        }

        $thumbsManager = new ThumbsManager();

        /* @var $thumbsData \ImageMS\models\Thumbs\ThumbsData */
        $thumbsData = $thumbsManager->getObjectData();
        $thumbsData->loadData($form->getAttributes());

        $thumbsRow = $thumbsManager->add($thumbsData);

        return $this->renderJsonMessage($thumbsRow);

    }

}