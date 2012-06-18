<?php
/**
 * TeamPHP
 * 
 * TeamPHP is a collaborative communication tool using twitter to allow groups
 * use a single twitter account with different users without giving away the
 * master account.
 * 
 * @package Teamphp_View_Helper
 * @category Teamphp
 */
/**
 * Application_View_Helper_Hosting
 * 
 * Quick view helper to display our generous hoster when deploying this
 * application. Current public choices are Combell, Orchestra and Windows
 * Azure. If a more generic logic is required, a database most likely required.
 * 
 * @package Teamphp_View_Helper
 * @category Teamphp
 */
class Application_View_Helper_Hosting extends Zend_View_Helper_Abstract 
{
    /**
     * @var Zend_View_Interface The view interface to use view components
     */
    protected $_view;

    /**
     * Sets the view object from the application
     * 
     * @param Zend_View_Interface $view
     */
    public function setView(Zend_View_Interface $view) 
    {
        $this->_view = $view;
    }
    /**
     * Returns a formatted string to display the current hoster the application
     * is hosted on.
     * 
     * @return string
     */
    public function hosting() 
    {
        $hosting = new StdClass;
        $hosting->url = 'http://www.combell.com';
        $hosting->tagline = 'Professional web hosting solutions &amp; servers for Linux and Windows with domain name. 24/7 phone support! The ideal hosting specialist for professionals.';
        $hosting->company = 'Combell Group NV';
        
        if (isset($_SERVER['OS']) && 'Windows_NT' === $_SERVER['OS']) {
            $hosting->url = 'http://www.windowsazure.com';
            $hosting->tagline = 'Windows Azure is an open and flexible cloud platform built for you.';
            $hosting->company = 'Microsoft / Windows Azure';
        }
        
        if (isset ($_SERVER['HTTP_HOST']) && 'orchestra.io' === substr($_SERVER['HTTP_HOST'], strlen($_SERVER['HTTP_HOST'] - 12))) {
            $hosting->url = 'http://www.orchestra.io';
            $hosting->tagline = 'Orchestra PHP is a Platform as a Service for PHP Hosting and managing PHP developed applications.';
            $hosting->company = 'Engine Yard / Orchestra';
        }
        return sprintf('<a href="%s" title="%s">%s</a>', $hosting->url, $hosting->tagline, $hosting->company);
    }

}
