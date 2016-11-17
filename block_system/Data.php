<?php

/**
 * @author shtorm
 */
class Application_Action_Ban_Data
{

    /**
     * @var Application_Action_Ban_Manager
     */
    private $_banManager;

    /**
     * @var Application_Action_Ban_Initiator_Manager_Interface
     */
    private $_objInitiatorManager;

    /**
     * @var Application_Action_Ban_Initiator_Data_Interface
     */
    private $_objInitiatorData;

    /**
     * @var string
     */
    private $_initiatorModelName;

    //--------------------------------------------------------------------------------------------------

    /**
     * @param string $initiatorModelName
     */
    public function __construct($initiatorModelName)
    {
        $this->_initiatorModelName = $initiatorModelName;
        $strInitiatorModelManager = $initiatorModelName . '_Manager';

        $this->_banManager = new Application_Action_Ban_Manager();
        $this->_objInitiatorManager = new $strInitiatorModelManager();
        $this->_objInitiatorData = $this->_objInitiatorManager->getDataObject();
    }

    /**
     * @param mixed $value
     * @param array $arrDataContext
     * @return boolean
     */
    public function checkAccess($value, $arrDataContext)
    {
        $this->_objInitiatorData->setData($arrDataContext);

        $bValideState = $this->_objInitiatorData->isValid($value);

        $row = $this->_objInitiatorManager->getRow();

        if ($bValideState === TRUE)
        {
            if (is_null($row))
            {
                return TRUE;
            }

            return $this->_banManager->processPositiveState($this->_initiatorModelName, $row->id(), $this->_objInitiatorManager->getBanRule());
        }
        else
        {
            if (is_null($row))
            {
                $row = $this->_objInitiatorManager->createNewRow();
            }

            return $this->_banManager->processNegativeState($this->_initiatorModelName, $row->id(), $this->_objInitiatorManager->getBanRule());
        }
    }

    /**
     * @return Application_Action_Ban_Initiator_Data_Interface
     */
    public function getInitiatorData()
    {
    	return $this->_objInitiatorData;
    }

    /**
     * @return Application_Action_Ban_Manager
     */
    public function manager()
    {
    	return $this->_banManager;
    }

    /**
     * @return string
     */
    public function getInitiatorModelName()
    {
    	return $this->_initiatorModelName;
    }

    /**
     * @return Application_Action_Ban_Initiator_Manager_Interface
     */
    public function getInitiatorManager()
    {
    	return $this->_objInitiatorManager;
    }

}