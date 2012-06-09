<?php

class Account_Model_Account extends In2it_Model_Model
{
    protected $_id;
    protected $_twitterId;
    protected $_screenName;
    protected $_token;
    
    public function parseToken(Zend_Oauth_Token_Access $token)
    {
        $this->setTwitterId($token->getParam('user_id'))
             ->setScreenName($token->getParam('screen_name'))
             ->setToken($token);
    }
    
    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
    public function getId()
    {
        return $this->_id;
    }
    public function setTwitterId($twitterId)
    {
        $this->_twitterId = (int) $twitterId;
        return $this;
    }
    public function getTwitterId()
    {
        return $this->_twitterId;
    }
    public function setScreenName($screenName)
    {
        $this->_screenName = (string) $screenName;
        return $this;
    }
    public function getScreenName()
    {
        return $this->_screenName;
    }
    public function setToken(Zend_Oauth_Token_Access $token)
    {
        $this->_token = $token;
        return $this;
    }
    public function getToken()
    {
        return $this->_token;
    }
    public function populate($row)
    {
        if (is_array($row)) {
            $row = new ArrayObject($row, ArrayObject::ARRAY_AS_PROPS);
        }
        if (isset ($row->id)) {
            $this->setId($row->id);
        }
        if (isset ($row->twitterId)) {
            $this->setTwitterId($row->twitterId);
        }
        if (isset ($row->screenName)) {
            $this->setScreenName($row->screenName);
        }
        if (isset ($row->token)) {
            $this->setToken(unserialize($row->token));
        }
    }
    public function toArray()
    {
        return array (
            'id' => $this->getId(),
            'twitterId' => $this->getTwitterId(),
            'screenName' => $this->getScreenName(),
            'token' => serialize($this->getToken()),
        );
    }
}

