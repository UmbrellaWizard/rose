<?php

class Rose_Controller_Plugin_Authorization extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $authorization_service = Rose_StaticLocator::getInstance()
            ->getAuthorizationService();

        $layout = Zend_Layout::getMvcInstance();
        $layout->assign('authorization_service', $authorization_service);
    }
}
