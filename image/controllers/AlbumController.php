<?php

namespace ImageMS\controllers;

use ImageMS\models\Album\form\CreateAlbum;
use ImageMS\models\Album\AlbumManager;
use ImageMS\models\Album\AlbumData;
use ImageMS\models\Album\form\AddToAlbum;
use ImageMS\models\Album\FileInformation\AlbumFileInformationManager;
use app\models\System\Controller\SystemControllerBase;

/**
 * @author Emil Vililyaev
 */
class AlbumController extends SystemControllerBase
{

    /**
     * Добавление альбома
     *
     * @example {"user": {"id": "1"},"data":{"name":"", "description":"", "file_information_id":1}}
     */
    public function actionCreate()
    {
        /* @var $request \app\modules\services\components\GiraffeRequest */
        $request = \Yii::$app->request;

        $data = $request->getApiData();

        $form = new CreateAlbum();
        $form->setAttributes($data);

        if (!$form->validate())
        {
            return $this->renderJsonMessage($form->getErrors());
        }

        $albumManager = new AlbumManager();

        /* @var $albumData AlbumData */
        $albumData = $albumManager->getObjectData();
        $albumData->loadFromForm($form);

        $albumRow = $albumManager->add($albumData);

        return $this->renderJsonMessage($albumRow);
    }

    /**
     * Добавление файла в альбом
     *
     * @example {"user": {"id": "1"},"data":{"album_id":1, "file_information_id":1}}
     */
    public function actionAddImageToAlbum()
    {
        /* @var $request \app\modules\services\components\GiraffeRequest */
        $request = \Yii::$app->request;

        $data = $request->getApiData();

        $form = new AddToAlbum();
        $form->setAttributes($data);

        if (!$form->validate())
        {
            return $this->renderJsonMessage($form->getErrors());
        }

        $albumFileInformationRow = (new AlbumFileInformationManager())->add($form->album_id, $form->file_information_id);

        return $this->renderJsonMessage($albumFileInformationRow);
    }

    /**
     * Добавление превью к альбому
     *
     * @example {"user": {"id": "1"},"data":{"album_id":1, "file_information_id":1}}
     */
    public function actionAddPreviewToAlbum()
    {
    /* @var $request \app\modules\services\components\GiraffeRequest */
        $request = \Yii::$app->request;

        $data = $request->getApiData();

        $form = new AddToAlbum();
        $form->setAttributes($data);

        if (!$form->validate())
        {
            return $this->renderJsonMessage($form->getErrors());
        }

        $albumRow = (new AlbumManager())->addFileInformationId($form->album_id, $form->file_information_id);

        return $this->renderJsonMessage($albumRow);
    }

}