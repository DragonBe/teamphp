<?php

class IndexController extends Zend_Controller_Action
{

    protected $_session = null;

    public function init ()
    {
        $this->_session = new Zend_Session_Namespace('twitter');
    }

    public function indexAction ()
    {
        // action body
    }

    /**
     * Temporary function for display purposes.
     */
    public function internalAction ()
    {
        $config = new Zend_Config(
                array(
                        'callbackUrl' => 'http://teamphp.local/auth/index/twitter-success',
                        'siteUrl' => 'http://twitter.com/oauth',
                        'consumerKey' => 'zr18H5PVztiRqlxDIFGTg',
                        'consumerSecret' => 'iBlZj32wlKj6w0jD2rnQnatAOSGiEertAWz2NrnuC9I'
                ));
        $account = new Account_Service_Account($config);
        $consumer = $account->getConsumer();

        $token = unserialize($this->_session->ACCESSTOKEN);
        
        // initializing variables first, just in case we have no values
        $timeLine = $directMessages = array ();
        if ($token != null) {
            $twitter = new Zend_Service_Twitter(
                    array(
                            'username' => $token->getParam('screen_name'),
                            'accessToken' => $token
                    ), $consumer);
            $timeLine = $twitter->statusUserTimeline(
                    array(
                            'user_id' => $token->getParam('user_id')
                    ));
            $directMessages = $twitter->directMessageMessages(array (
                array (
                    'user_id' => $token->getParam('user_id'),
                ),
            ));
        }
        // var_dump($token);die;

        if (isset($timeLine)) {
            $this->view->assign(array (
                'tweets' => $timeLine,
                'directMessages' => $directMessages,
            ));
        }
    }
}

