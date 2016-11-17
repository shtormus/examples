<?php

namespace ImageMS\models\Thumbs\Category\form;

use yii\base\Model;
use app\models\System\SystemFormAbstract;
use ImageMS\models\Thumbs\Category\ThumbsCategoryManager;

/**
 * @author Emil Vililyaev
 */
class CategoryForm extends SystemFormAbstract
{
    /**
     * @var string
     */
    public $category_name;

    /**
     * @var string
     */
    public $category_description;

    /* (non-PHPdoc)
     * @see \yii\base\Model::rules()
     */
    public function rules()
    {
        return [
            [['category_name'], 'required'],
            [['category_name'], 'categoryIsExist'],
            [['category_description'], 'string'],
        ];
    }

    /**
     * @param string $attribute
     */
    public function categoryIsExist($attribute)
    {
        $thumbsCategoryManager = new ThumbsCategoryManager();
        $category = $thumbsCategoryManager->getCategoryByName($this->{$attribute});

        if (!is_null($category))
        {
            $this->addError('thumbsCategoryId', 'Thumbs category by name "' . $this->{$attribute} . '" already exist');
        }
    }

}