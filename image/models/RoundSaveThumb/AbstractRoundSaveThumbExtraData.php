<?php

namespace ImageMS\models\RoundSaveThumb;

use app\models\System\SystemImage;

/**
 * @author Emil Vililyaev
 */
abstract class AbstractRoundSaveThumbExtraData
{

    /**
     * @var SystemImage
     */
    protected $_objImage;

    //-----------------------------------------------------------------------------------------------------------

    /**
     * @return string[]
     */
    public function __sleep()
    {
        return [
            'rect',
            'rotate',
        ];
    }

    /**
     * @param array $arrProperty
     */
    public function loadData($arrProperty)
    {
        $properties = get_object_vars($this);

        foreach ($arrProperty as $key => $value)
        {
            if (is_null($value) || !array_key_exists($key, $properties))
            {
                continue;
            }
            switch ($key)
            {
                case "rect":

                    if (!isset($value['width']) || !isset($value['height']) || !isset($value['x']) || !isset($value['y']))
                    {
                        throw new \ErrorException('rect param not passed');
                    }

                    $this->$key = [
                        $value['width'],
                        $value['height'],
                        $value['x'],
                        $value['y'],
                    ];
                    break;
                default :
                    $this->$key = $value;
                    break;

            }

        }
    }

    /**
     * метод инициализации
     */
    public function init(SystemImage $objImage)
    {
        $this->_objImage = $objImage;

        return $this;
    }

    /**
     * Пустой метод основной логики для переопределения в наследниках
     */
    public function process() {}

    /**
     * Пустой метод валидации данных для переопределения в наследниках
     */
    public function validate() {}

}