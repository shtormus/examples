<?php

/**
 * @author shtorm
 */
interface Application_Action_Ban_Initiator_Data_Interface
{
    
    /**
     * @param array $arrData
     */
    public function setData($arrData);
    
    /**
     * @param mixed $value
     */
    public function isValid($value);
    
}