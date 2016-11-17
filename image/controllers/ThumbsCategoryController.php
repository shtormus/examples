<?php

namespace ImageMS\controllers;

use ImageMS\models\Thumbs\Category\ThumbsCategoryManager;
use ImageMS\models\Thumbs\Category\form\CategoryForm;
use app\models\System\Controller\SystemControllerBase;

/**
 * @author Emil Vililyaev
 */
class ThumbsCategoryController extends SystemControllerBase
{

    /**
     * create image thumb category
     *
     * @example {"user": {"id": "1"},"data":{"category_name":"", "category_description":""}}
     */
    public function actionCreate()
    {
        /* @var $request \app\modules\services\components\GiraffeRequest */
        $request = \Yii::$app->request;

        $data = $request->getApiData();

        $form = new CategoryForm();
        $form->setAttributes($data);

        if (!$form->validate())
        {
            return $this->renderJsonMessage($form->getErrors());
        }

        $thumbsCategory = (new ThumbsCategoryManager())->add($form->category_name, $form->category_description);

        return $this->renderJsonMessage($thumbsCategory);

    }

}