<?php
/**
 * @author Никита
 * @date 16/05/16
 * @author Emil Vililyaev
 */

namespace ImageMS\models\File\form;

use Yii;
use yii\validators\Validator;
use app\models\System\DevelopDebug;

class ImageValidator extends Validator
{
    public $imageTypes;
    public $maxSize;

    public $notImage;
    public $wrongImageType;
    public $tooBig;

    public function init()
    {
        parent::init();

        if ($this->notImage === null) {
            $this->notImage = Yii::t('yii', 'The file is not an image.');
        }

        if ($this->wrongImageType === null) {
            $this->wrongImageType = Yii::t('yii', 'Wrong image type.');
        }

        if ($this->tooBig === null) {
            $this->tooBig = Yii::t('yii', 'The file is too big. Its size cannot exceed {formattedLimit}.');
        }
    }

    public function validateValue($value)
    {
        if (false === ($imageInfo = getimagesizefromstring($value))) {
            return [$this->notImage, []];
        }

        if (!in_array($imageInfo[2], $this->imageTypes)) {
            return [$this->wrongImageType, []];
        }

        if (mb_strlen($value, '8bit') > $this->maxSize) {
            return [$this->tooBig, [
                'limit' => $this->maxSize,
                'formattedLimit' => Yii::$app->formatter->asShortSize($this->maxSize),
            ]];
        }

        return null;
    }
}