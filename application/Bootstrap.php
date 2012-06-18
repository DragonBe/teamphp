<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap 
{

    public function _initViewSetup()
    {
        // Initialize view
        $view = $this->getPluginResource('view')->getView();
        $view->headTitle('TeamPHP');
        $view->headTitle()->setSeparator(' - ');
        $view->headLink()->appendStylesheet($view->baseUrl('/css/style.css'));
        $view->headMeta()->setHttpEquiv(
            'text/html; Charset=UTF-8', 'Content-Type'
        );
        
        // Add it to the ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
            'ViewRenderer'
        );
        $viewRenderer->setView($view);
        
        // Return it, so that it can be stored by the bootstrap
        return $view;
    }
    
    public function _initTopNavigation() 
    {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');
        $navigation = new Zend_Navigation($config);
        $view->navigation($navigation);
    }

}

