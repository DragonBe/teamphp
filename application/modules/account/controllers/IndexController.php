<?php

class Account_IndexController extends Zend_Controller_Action
{
    protected $_session;
    
    public function init()
    {
        $this->_session = new Zend_Session_Namespace('twitter');
    }

    public function indexAction()
    {
        // action body
    }

    public function authAction()
    {
        $config = new Zend_Config(array (
            'callbackUrl'    => 'http://teamphp.local/account/index/verify',
            'siteUrl'        => 'http://twitter.com/oauth',
            'consumerKey'    => 'zr18H5PVztiRqlxDIFGTg',
            'consumerSecret' => 'iBlZj32wlKj6w0jD2rnQnatAOSGiEertAWz2NrnuC9I',
        ));
        $account = new Account_Service_Account($config);
        $token = $account->authAccount();
        $this->_session->REQTOKEN = serialize($token);
        unset ($this->_session->ACCESSTOKEN);
        $account->getConsumer()->redirect();
    }

    public function verifyAction()
    {
        if (!isset ($this->_session->ACCESSTOKEN)) {
            $config = new Zend_Config(array (
                'callbackUrl'    => 'http://teamphp.local/auth/index/twitter-success',
                'siteUrl'        => 'http://twitter.com/oauth',
                'consumerKey'    => 'zr18H5PVztiRqlxDIFGTg',
                'consumerSecret' => 'iBlZj32wlKj6w0jD2rnQnatAOSGiEertAWz2NrnuC9I',
            ));
            $requestToken = unserialize($this->_session->REQTOKEN);
            $account = new Account_Service_Account($config);
            $token = $account->verifyAccount($this->getRequest(), $requestToken);
            var_dump($token);
            $this->_session->ACCESSTOKEN = serialize($token);
            var_dump($_SESSION);die('In setup');
        }
        $token = unserialize($this->_session->ACCESSTOKEN);
        
        $accountMapper = new Account_Model_AccountMapper();
        $accountModel = new Account_Model_Account();
        $accountModel->parseToken($token);
        var_dump($token);
    }


}





