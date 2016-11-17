<?php

namespace ImageMS\models\File\Information\Enum;

use app\models\System\Enum;

/**
 * @author Emil Vililyaev
 */
class Status extends Enum
{

    /**
     * @var integer
     */
    const CREATED = 1;

    /**
     * @var integer
     */
    const DELETED = 2;

}