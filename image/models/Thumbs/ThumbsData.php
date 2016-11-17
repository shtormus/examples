<?php

namespace ImageMS\models\Thumbs;

use app\models\System\SystemObjectData;
use app\models\System\DevelopDebug;

/**
 * @author Sergey Ivanov
 *
 * @property integer $id
 * @property integer $thumb_category_id
 * @property string $name
 * @property integer $width
 * @property integer $heigth
 * @property string $description
 *
 */
class ThumbsData extends SystemObjectData
{

    /**
     * @param array $formData
     * @return \ImageMS\models\Thumbs\ThumbsData
     */
    public function loadData($formData)
    {
        $arrAttr = $this->getObject()->getAttributes();
        
        foreach ($formData as $key => $value)
        {
            if (is_null($value) || !array_key_exists($key, $arrAttr))
            {
                continue;
            }

            $this->$key = $value;
         }
         
        return $this;
    }

}