<?php

namespace ImageMS\models\Thumbs\Category;

use app\models\System\SystemManager;

/**
 * @author Sergey Ivanov
 */
class ThumbsCategoryManager extends SystemManager
{

    /**
     * @param string $name
     * @param string $description
     * @return self
     */
    public function add($name, $description) : ThumbsCategory
    {
        $row = new ThumbsCategory();
        $row
            ->setName($name)
            ->setDescription($description)
            ->save()
        ;

        if (!$row->getId())
        {
            return null;
        }

        return $row;
    }

    /**
     * @param integer $id
     * @return boolean
     */
    public function isExist($id)
    {
        $row = ThumbsCategory::find()->where(['id' => $id])->one();

        return !is_null($row);
    }

    /**
     * @param integer $id
     * @return \ImageMS\models\Thumbs\Category\ThumbsCategory
     */
    public function getCategoryById($id)
    {
        return ThumbsCategory::find()->where(['id' => $id])->one();
    }

    /**
     * @param string $name
     * @return \ImageMS\models\Thumbs\Category\ThumbsCategory
     */
    public function getCategoryByName($name)
    {
        return ThumbsCategory::findOne(['name' => $name]);
    }

}