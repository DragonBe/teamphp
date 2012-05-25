<?php

class Account_Model_AccountTest extends PHPUnit_Framework_TestCase
{
    public function testAuthAccount()
    {
        $config = new Zend_Config(array (
            'callbackUrl'    => 'http://teamphp.local/auth/index/twitter-success',
            'siteUrl'        => 'http://twitter.com/oauth',
            'consumerKey'    => 'zr18H5PVztiRqlxDIFGTg',
            'consumerSecret' => 'iBlZj32wlKj6w0jD2rnQnatAOSGiEertAWz2NrnuC9I',
        ));
        $account = new Account_Service_Account($config);
        $requestToken = $account->authAccount();
        
        $this->assertType('Zend_Oauth_Token_Request', $requestToken);
    }
}