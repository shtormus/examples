<?php

namespace ImageMS\models\Thumbs\form;

use yii\base\Model;
use app\models\System\SystemFormAbstract;
use ImageMS\models\Thumbs\Category\ThumbsCategoryManager;

/**
 * @author Emil Vililyaev
 */
class CreateForm extends SystemFormAbstract
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $width;

    /**
     * @var string
     */
    public $heigth;

    /**
     * @var string
     */
    public $description;

    /**
     * @var integer
     */
    public $thumb_category_id;

    /* (non-PHPdoc)
     * @see \yii\base\Model::rules()
     */
    public function rules()
    {
        return [
            [['name', 'width', 'heigth', 'thumb_category_id'], 'required'],
            [['width', 'heigth', 'thumb_category_id'], 'integer'],
            ['thumb_category_id', 'categoryIsExist'],
            [['description'], 'string'],
        ];
    }

    /**
     * @param string $attribute
     */
    public function categoryIsExist($attribute)
    {
        $thumbsCategoryManager = new ThumbsCategoryManager();

        if (!$thumbsCategoryManager->isExist($this->{$attribute}))
        {
            $this->addError('thumbsCategoryId', 'Thumbs category by ID "' . $this->{$attribute} . '" not found');
        }
    }

}