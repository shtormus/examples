<?php

/**
 * @author shtorm
 */
class Application_Action_Ban_Validate_Access extends ***
{

    const NOT_AVAILABLE = 'resourceNotAvailable';

    //--------------------------------------------------------------------------------------

    /**
     * @var Application_Action_Ban_Data
     */
    protected $_objBanData;

    //--------------------------------------------------------------------------------------

    /**
     * @param string $initiatorModelManager
     */
    public function __construct($initiatorModelManager)
    {
        $this->_objBanData = new Application_Action_Ban_Data($initiatorModelManager);
    }

    //--------------------------------------------------------------------------------------

    /* (non-PHPdoc)
     * @see ***
     */
    public function isValid($value, $context = NULL)
    {
        $bAccess = $this->_objBanData->checkAccess($value, $context);

        if (!$bAccess)
        {
            $this->_error(self::NOT_AVAILABLE);
            return FALSE;
        }

        return TRUE;

    }

}