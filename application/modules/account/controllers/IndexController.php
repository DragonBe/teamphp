<?php

class Account_IndexController extends Zend_Controller_Action
{

    protected $_session = null;

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
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/app.ini', APPLICATION_ENV);
        $account = new Account_Service_Account($config->twitter);
        $token = $account->authAccount();
        $this->_session->REQTOKEN = serialize($token);
        unset ($this->_session->ACCESSTOKEN);
        $account->getConsumer()->redirect();
    }

    public function verifyAction()
    {
        if (!isset ($this->_session->ACCESSTOKEN)) {
            $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/app.ini', APPLICATION_ENV);
            $requestToken = unserialize($this->_session->REQTOKEN);
            $account = new Account_Service_Account($config->twitter);
            $token = $account->verifyAccount($this->getRequest(), $requestToken);
            $this->_session->ACCESSTOKEN = serialize($token);
        }
        $token = unserialize($this->_session->ACCESSTOKEN);
        
        $accountMapper = new Account_Model_AccountMapper();
        $accountModel = new Account_Model_Account();
        $accountModel->parseToken($token);
        $accountMapper->save($accountModel);
        
        return $this->_helper->redirector('internal', 'index', 'default');
    }

    public function showAccountAction()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/app.ini', APPLICATION_ENV);
        $account = new Account_Service_Account($config->twitter);
        $consumer = $account->getConsumer();
        $token = unserialize($this->_session->ACCESSTOKEN);
//        var_dump($token);die;
        $twitter = new Zend_Service_Twitter(array (
            'username' => $token->getParam('screen_name'),
            'accessToken' => $token,
        ), $consumer);
        $timeLine = $twitter->statusUserTimeline(array ('user_id' => $token->getParam('user_id')));
        $this->view->timeLine = $timeLine;
    }


}







