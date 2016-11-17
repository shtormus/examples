<?php

namespace ImageMS;

use Yii;
use ImageMS\models\RoundSaveThumb\RoundSaveThumbManager;

/**
 * @author sergey
 */
class Facade
{

    /**
     * запускает процесс обработки очереди для создания тумб
     */
    public function createThumbsProcess()
    {
        return (new RoundSaveThumbManager())->process();
    }
    
}