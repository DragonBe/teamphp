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
    
    public function save(In2it_Model_Model $account)
    {
        $checkModel = new Account_Model_Account();
        $this->fetchRow($checkModel, array (
            'twitterId = ?' => $account->getTwitterId(),
            'twitterName = ?' => $account->getTwitterName(),
        ));
        if (null !== $checkModel) {
            $account->setId($checkModel->getId());
        }
        parent::save($account);
    }
}