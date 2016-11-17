<?php

/**
 * @author shtorm
 */
interface Application_Action_Ban_Initiator_Manager_Interface
{
    
    /**
     * @return Application_Action_Ban_Initiator_Data_Interface
     */
    public function getDataObject();
    
    /**
     * @return System_Db_Object
     */
    public function createNewRow();
    
    /**
     * @return System_Db_Object|NULL
     */
    public function getRow();
    
    /**
     * @return Application_Action_Ban_Rules_Enum const
     */
    public function getBanRule();
    
}