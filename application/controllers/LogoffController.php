<?php

class LogoffController extends Zend_Controller_Action {

    private $modelUser;

    public function init() {
        $this->modelUser = new Application_Model_Usuario();

        $this->modelUser->logoutAction();
        $this->_helper->redirector('index', 'Index');
    }

    public function indexAction() {
        
    }

}
