<?php

class IndexController extends Zend_Controller_Action 
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
    /**
     * Temporary function for display purposes.
     */
    public function internalAction() 
    {
        $config = new Zend_Config ( array (
            'callbackUrl' => 'http://teamphp.local/auth/index/twitter-success',
            'siteUrl' => 'http://twitter.com/oauth',
            'consumerKey' => 'zr18H5PVztiRqlxDIFGTg',
            'consumerSecret' => 'iBlZj32wlKj6w0jD2rnQnatAOSGiEertAWz2NrnuC9I'
        ) );
        $account = new Account_Service_Account ( $config );
        $consumer = $account->getConsumer ();
        $token = unserialize ( $this->_session->ACCESSTOKEN );
        // var_dump($token);die;
        $twitter = new Zend_Service_Twitter ( array (
            'username' => $token->getParam ( 'screen_name' ),
            'accessToken' => $token
        ), $consumer );
        $timeLine = $twitter->statusUserTimeline ( array (
            'user_id' => $token->getParam ( 'user_id' )
        ) );


        $this->view->tweets = $timeLine;
    }
}

