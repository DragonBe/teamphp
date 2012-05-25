<?php
/**
 * Account_Service_Account
 * 
 * Provides a service to access the Twitter Oauth auhtentication service for
 * auhtorizing this app to access twitter account rights.
 * 
 * @category Teamphp
 * @package Account
 * @subpackage Service
 */
class Account_Service_Account
{
    /**
     * @var Zend_Config Configuration settings for the Oauth service
     */
    protected $_config;
    /**
     * @var Zend_Oauth_Consumer The Oauth consumer component
     */
    protected $_consumer;
    /**
     * Constructor that requires configuration settings
     * 
     * @param Zend_Config $config 
     */
    public function __construct($config)
    {
        $this->setConfig($config);
        $this->setConsumer(new Zend_Oauth_Consumer($config));
    }
    /**
     * Sets the configuration for this Oauth implementation
     * 
     * @param Zend_Config $config
     * @return Account_Service_Account 
     */
    public function setConfig(Zend_Config $config)
    {
        $this->_config = $config;
        return $this;
    }
    /**
     * Retrieves the configuration from this Oauth implementation
     * 
     * @return Zend_Config
     */
    public function getConfig()
    {
        return $this->_config;
    }
    /**
     * Sets the consumer for this Oauth implementation
     * 
     * @param Zend_Oauth_Consumer $consumer
     * @return Account_Service_Account 
     */
    public function setConsumer(Zend_Oauth_Consumer $consumer)
    {
        $this->_consumer = $consumer;
        return $this;
    }
    /**
     * Retrieves the Oauth consumer from this Oauth implementation
     * 
     * @return Zend_Oauth_Consumer
     */
    public function getConsumer()
    {
        return $this->_consumer;
    }
    /**
     * Creates an authorisation request token
     * 
     * @return Zend_Oauth_Token_Request
     */
    public function authAccount()
    {
        $token = null;
        try {
            $token = $this->getConsumer()->getRequestToken();
        } catch (Zend_Oauth_Exception $exception) {
            //@todo Log these exceptions
            return false;
        }
        return $token;
    }
    /**
     * Verifies the authorization and generates an accesstoken
     * 
     * @param Zend_Http_Request $request
     * @param Zend_Oauth_Token_Request $requestToken
     * @return Zend_Oauth_Token_Access
     */
    public function verifyAccount($request, Zend_Oauth_Token_Request $requestToken)
    {
        $token = null;
        try {
            $token = $this->getConsumer()->getAccessToken($request->getParams(), $requestToken);
        } catch (Zend_Oauth_Exception $exception) {
            //@todo Log these exceptions
            return false;
        }
        return $token;
    }
    
}