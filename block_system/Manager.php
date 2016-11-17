<?php

/**
 * @author shtorm
 * @method Application_Action_Ban_Row createNew()
 * @method Application_Action_Ban_Table getTable()
 */
class Application_Action_Ban_Manager extends ***
{

    //------------------------------------------------------------------------------------------------------------------
    /* Не доделанный метод для получения времени блокировки
     * @author shtorm
     */

    public function getLockTime($banRowId)
    {
        $row = $this->get($banRowId);

        if (is_null($row))
        {
            return;
        }

        $timeTo = new Zend_Date($row->timeTo());
        $timeLocked = new Zend_Date($row->timeLocked());
        $difference = $timeTo->sub($timeLocked);

        $measure = new Zend_Measure_Time($difference->toValue(), Zend_Measure_Time::SECOND);
        $measure->convertTo(Zend_Measure_Time::MINUTE);

        $measure->toString(); //@todo тут все рабочее, надо определиться в каком формате возвращать результат
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param string $modelName
     * @param integer $objectId
     * @param string $banRule
     * @return Application_Action_Ban_Row
     */
    public function lock($modelName, $objectId, $banRule)
    {
        $row = $this->_getActualRow($modelName, $objectId, FALSE);

        if (is_null($row))
        {
            $row = $this->_add($modelName, $objectId, $banRule);
        }
        else
        {
            $row
                ->setTimes($banRule)
                ->save()
            ;
        }

        return $row;
    }

    /**
     * @param string $modelName
     * @param integer $objectId
     * @param string $banRule
     * @return boolean
     */
    public function processNegativeState($modelName, $objectId, $banRule)
    {
        $row = $this->_getActualRow($modelName, $objectId, FALSE);

        if (is_null($row))
        {
            $this->_add($modelName, $objectId, $banRule);

            return FALSE;
        }

        if (!$row->getRuleObject($banRule)->isLocked($row))
        {
            $this->lock($modelName, $objectId, $banRule);
        }

        return FALSE;
    }

    /**
     * @param string $modelName
     * @param integer $objectId
     * @return boolean
     */
    public function processPositiveState($modelName, $objectId, $banRule)
    {
        $row = $this->_getActualRow($modelName, $objectId, FALSE);

        if (is_null($row))
        {
            return TRUE;
        }

        if ($row->getRuleObject($banRule)->isLocked($row))
        {
            return FALSE;
        }

        $this->unlock($modelName, $objectId);
        return TRUE;
    }

    /**
     * @param string $modelName
     * @param integer $objectId
     * @return number
     */
    public function getWrongAttempts($modelName, $objectId)
    {
        $row = $this->_getActualRow($modelName, $objectId);

        return (int)$row->attempts();
    }

    /**
     * @param string $modelName
     * @param integer $objectId
     * @return Application_Action_Ban_Row
     */
    public function unlock($modelName, $objectId)
    {
        $row = $this->_getActualRow($modelName, $objectId);

        $row
            ->status(Application_Action_Ban_Status_Enum::NOT_ACTUAL)
            ->save()
        ;

        return $row;
    }

    //--------------------------------------------------------------------------------------------------------------------------------------------------------------

    /**
     * @param string $modelName
     * @param integer $objectId
     * @param integer $banRule
     * @return Application_Action_Ban_Row
     */
    protected function _add($modelName, $objectId, $banRule)
    {
        $row = $this->createNew();
        $row
            ->modelName($modelName)
            ->objId($objectId)
            ->setTimes($banRule)
            ->status(Application_Action_Ban_Status_Enum::ACTUAL)
            ->save()
        ;

        return $row;
    }

    /**
     * @param string $modelName
     * @param integer $objectId
     * @param boolean $checkExisting
     * @param integer $status
     * @return Application_Action_Ban_Row
     * @throws System_Exception
     */
    protected function _getActualRow($modelName, $objectId, $checkExisting = TRUE, $status = Application_Action_Ban_Status_Enum::ACTUAL)
    {
        $row = $this->getTable()->getRowByNameAndObjId($modelName, $objectId, $status);

        if ($checkExisting)
        {
            System_Exception_Null::getInstance()->validate($row,
                'Record with object ID "' . $objectId . '" and model name "' . $modelName . '" was not found in database. Table: "' . $this->getTable()->getClassName() . '"');
        }

        return $row;
    }

}