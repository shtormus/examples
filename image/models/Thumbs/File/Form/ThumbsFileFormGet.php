<?php

namespace ImageMS\models\Thumbs\File\Form;

use app\models\System\SystemFormAbstract;
use app\models\System\Validator\SystemDbExists;
use ImageMS\models\Thumbs\Category\ThumbsCategory;
use ImageMS\models\Thumbs\Thumbs;
use app\models\System\DevelopDebug;
use yii\helpers\Json;
use ImageMS\models\File\Information\FileInformation;

/**
 * @author Sergey Ivanov
 */
class ThumbsFileFormGet extends SystemFormAbstract
{

    /**
     * @var string
     */
    public $categoryName;

    /**
     * @var array
     */
    public $thumbsName;

    /**
     * @var integer
     */
    public $fileInformationId;

    /**
     * @var ThumbsCategory
     */
    private $_categoryRow;

    //---------------------------------------------------------------------------------------------------------------------

    /* (non-PHPdoc)
     * @see \yii\base\Model::rules()
     */
    public function rules()
    {
        return [
            [['categoryName', 'fileInformationId'], 'required'],
            ['fileInformationId', 'integer'],
            ['fileInformationId', 'validateFileInformation'],
            ['categoryName', 'string'],
            ['thumbsName', 'disableXss'],
            ['categoryName', 'validateCategoryName'],
            ['thumbsName', 'validateThumbsName'],
        ];
    }

    //-----------------------------------------------------------------------------------------------------------

    public function validateFileInformation()
    {
        $bExists = SystemDbExists::getInstance()->validateField(FileInformation::className(), 'id', $this->fileInformationId);

        if (!$bExists)
        {
            $this->addError('fileInformationId', 'FILE_NOT_EXISTS');
        }
    }

    /**
     * валидация переданной категории
     */
    public function validateCategoryName()
    {
        $thumbsCategoryRow = ThumbsCategory::find()->where(['name' => $this->categoryName])->one();

        if (is_null($thumbsCategoryRow))
        {
            $this->addError('categoryName', 'CATEGORY_NOT_EXISTS');
            return false;
        }

        $this->_categoryRow = $thumbsCategoryRow;
    }

    /**
     * валидация переданных названий тумб у категории
     */
    public function validateThumbsName()
    {

        if (!is_array($this->thumbsName) || empty($this->thumbsName))
        {
            $this->addError('thumbsName', 'THUMBS_IS_EMPTY');
            return false;
        }

        foreach ($this->thumbsName as $thumbName)
        {
            $thumbRow = Thumbs::findOne([
                'thumb_category_id' => $this->_categoryRow->getId(),
                'name'              => $thumbName
            ]);

            if (is_null($thumbRow))
            {
                $this->addError('thumbsName', $thumbName . ' IS_NOT_EXITSTS');
            }
        }
    }

    /**
     * получения категории после валиадации данных
     *
     * @return \ImageMS\models\Thumbs\Category\ThumbsCategory
     */
    public function getCategoryRow()
    {
        return $this->_categoryRow;
    }

}