<?php

namespace ImageMS\models\RoundSaveThumb\Enum;

use app\models\System\Enum;

/**
 * @author Sergey Ivanov
 */
class Status extends Enum
{
    
    /**
     * @var integer
     */
    const CREATED                   = 1;
    
    /**
     * @var integer
     */
    const PROCESS                   = 2;
    
    /**
     * @var integer
     */
    const DONE                      = 3;
    
    /**
     * @var integer
     */
    const FAIL                      = 4;
    
}