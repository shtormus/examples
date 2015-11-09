<?php

/**
 * @author shtorm
 */
interface Application_Action_Ban_Rules_Interface
{

    /**
     * @return boolean
     */
    public function isLocked(Application_Action_Ban_Row $row);

    /**
     * @return string mysqlTimeStamp()
     */
    public function getBanTime($iteration);

}