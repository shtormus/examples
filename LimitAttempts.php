<?php

/**
 * @author shtorm
 */
class Application_Action_Ban_Rules_LimitAttempts implements Application_Action_Ban_Rules_Interface
{

    /* (non-PHPdoc)
     * @see Application_Action_Ban_Rules_Interface::isLocked()
     */
    public function isLocked(Application_Action_Ban_Row $row)
    {
		$availableAttempts = $this->_getAvailableAttempts($row->modelName());

		return (int)$row->attempts() >= (int)$availableAttempts;
    }

    /* (non-PHPdoc)
     * @see Application_Action_Ban_Rules_Interface::getBanTime()
     */
    public function getBanTime($iteration)
    {
		return (new System_Date_Utc())->toMysqlTimestamp();
    }

    /**
     * @param string $initiatorModelName
     * @return integer
     */
    private function _getAvailableAttempts($initiatorModelName)
    {
    	$initiatorManager = $initiatorModelName . '_Manager';

    	try {
			$objInitiator = new $initiatorManager();
			return $objInitiator->getAvailableAttempts();
    	}
    	catch (Exception $e)
    	{
    		return 3; //@todo хардкод
    	}
    }

}