<?php

/**
 * @author shtorm
 */
class Application_Action_Ban_Rules_TimeDoubling implements Application_Action_Ban_Rules_Interface
{

    /* (non-PHPdoc)
     * @see Application_Action_Ban_Rules_Interface::getBanTime()
     */
    public function getBanTime($iteration)
    {
        $date = new System_Date_Utc();
        $banTime = $iteration < 1 ? 1 : (1 << $iteration);

        return $date->addMinute($banTime)->toMysqlTimestamp();
    }

    /* (non-PHPdoc)
     * @see Application_Action_Ban_Rules_Interface::isLocked()
     */
    public function isLocked(Application_Action_Ban_Row $row)
    {
    	$objDate = new System_Date_Utc();
    	return $objDate->isEarlier($row->timeTo(), System_Date::MYSQL_TIMESTAMP);
    }

}