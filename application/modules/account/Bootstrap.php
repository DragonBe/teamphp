<?php

class Account_Bootstrap extends Zend_Application_Module_Bootstrap
{
    public function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(
            array(
                'namespace' => 'Account_',
                'basePath'  => dirname(__FILE__),
            )
        );
        return $autoloader;
    }
}