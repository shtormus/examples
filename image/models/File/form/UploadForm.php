<?php

namespace ImageMS\models\File\form;

use ImageMS\Module;
use yii\base\Model;
use GuzzleHttp\Client;
use app\models\System\SystemFormAbstract;
use app\models\System\Validator\Base64ImageValidator;
use GuzzleHttp\Exception\ClientException;
use ImageMS\models\Thumbs\Category\ThumbsCategoryManager;

/**
 * @author Никита
 * @date 16/05/16
 * @author Emil Vililyaev
 */
class UploadForm extends SystemFormAbstract
{

    /**
     * кол-во секунд, если по урлу загружаем фото - ожидание запроса на загрузки фото
     *
     * @var int
     */
    const TIMEOUT = 10;

    //------------------------------------------------------------------------------------------------------------------------------------

    /**
     * @var string
     */
    private $_imageContent;

    //------------------------------------------------------------------------------------------------------------------------------------

    /**
     * @var string
     */
    public $base64Image;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $title;

    /**
     * @var integer
     */
    public $thumbsCategoryId;

    /**
     * @var string
     */
    public $description;

    //------------------------------------------------------------------------------------------------------------------------------------

    /* (non-PHPdoc)
     * @see \yii\base\Model::rules()
     */
    public function rules()
    {
        return [
            ['thumbsCategoryId', 'required', 'on' => 'withCategory'],
            ['thumbsCategoryId', 'integer', 'on' => 'withCategory'],
            ['thumbsCategoryId', 'categoryIsExist', 'on' => 'withCategory'],
            [['name'], 'required'],
            [['title', 'url', 'description', 'base64Image'], 'string'],
        ];
    }

    //------------------------------------------------------------------------------------------------------------------------------------

    /**
     * @return string
     */
    public function getImageContent()
    {
        if (is_null($this->base64Image))
        {
            return $this->_imageContent;
        }

        return base64_decode($this->base64Image);
    }

    /* (non-PHPdoc)
     * @see \yii\base\Model::afterValidate()
     */
    public function afterValidate()
    {
        if (!$this->hasErrors())
        {
            $this->_imageContent = $this->getImageContent();

            $validator = new ImageValidator([
                'imageTypes'    => Module::getInstance()->params['ImageTypes'],
                'maxSize'       => Module::getInstance()->params['MaxSizePhoto'],
            ]);

            if (!$validator->validate($this->getImageContent(), $error)) {
                $this->addError('base64Image', $error);
            }
        }

        parent::afterValidate();
    }

    /**
     * @param string $attribute
     */
    public function categoryIsExist($attribute)
    {
        $thumbsCategoryManager = new ThumbsCategoryManager();

        if (!$thumbsCategoryManager->isExist($this->{$attribute}))
        {
            $this->addError('thumbsCategoryId', 'Thumbs category ID not exist');
        }
    }

    /**
     * @param string $attribute
     */
    public function validUrl($attribute)
    {
        try
        {
            $response = (new Client())->get($this->{$attribute}, ['timeout' => self::TIMEOUT]);

            if ($response->getStatusCode() == 200)
            {
                $this->_imageContent = $response->getBody();
            }
            else
            {
                $this->addError('url', 'URL not available'); //@todo подготовить под мультиязычность
            }
        }
        catch (\Exception $e)
        {
            $this->addError('url', 'Error image content'); //@todo подготовить под мультиязычность
        }
    }

    /* (non-PHPdoc)
     * @see \yii\base\Model::validate($attributeNames, $clearErrors)
     */
    public function validate($attributeNames = null, $clearErrors = true)
    {
        if (!is_null($this->base64Image))
        {
            $validator = new Base64ImageValidator();
            $validator->validateAttribute($this, 'base64Image');
        }
        else
        {
            $this->validUrl('url');
        }

        return parent::validate($attributeNames, false);
    }

}