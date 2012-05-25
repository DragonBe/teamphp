<?php

class Account_Model_AccountMapper extends In2it_Model_Mapper
{
    public function getDbTable() 
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Account_Model_DbTable_Account');
        }
        return parent::getDbTable();
    }
}