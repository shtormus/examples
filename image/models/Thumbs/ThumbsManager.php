<?php

namespace ImageMS\models\Thumbs;

use app\models\System\SystemManager;
use ImageMS\models\Thumbs\ThumbsData;

/**
 * @author Sergey Ivanov
 */
class ThumbsManager extends SystemManager
{

    /**
     * @param ThumbsData $data
     * @return NULL|\ImageMS\models\Thumbs\Thumbs
     */
    public function add(ThumbsData $data) : Thumbs
    {
        $row = new Thumbs();
        $row
            ->setThumbCategoryId($data->thumb_category_id)
            ->setName($data->name)
            ->setWidth($data->width)
            ->setHeigth($data->heigth)
            ->setDescription($data->description)
            ->save()
        ;

        return $row;

    }

    /**
     * @param integer $id
     * @return \ImageMS\models\Thumbs\Thumbs
     */
    public function getThumbsListByCategoryId($id)
    {
        return Thumbs::findAll(['thumb_category_id' => $id]);
    }

}
