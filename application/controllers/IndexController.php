<?php

class IndexController extends Zend_Controller_Action {

    private $modelUser = null;

    public function init() {
        $this->modelUser = new Application_Model_Usuario();
        $identity = Zend_Auth::getInstance()->getIdentity();
        print_r($identity);
        if ($identity != null) {
            $this->_helper->redirector('index','Projeto');  
        }
    }

    public function indexAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->layout->setLayout('login');
        $array = $this->getAllParams();
        if (array_key_exists('nome_usuario', $array)) {
            if ($this->modelUser->loguin($array['nome_usuario'], $array['senha'])) {
                $this->_redirect('projeto');
            } else {
                $this->view->resultlogin = "usuario e senha nao existe";
            }
        }
    }

    public function cadastroAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->layout->setLayout('cadastro');
        $this->aviso = "null";
        $array = $this->getAllParams();
        if (array_key_exists('login_c', $array)) {
            if ($array['login_c'] == "") {
                $this->view->aviso = "insira um nome de usuario valido";
                return;
            }

            if ($array['senha_c'] == $array['senha2_c']) {
                if ($this->modelUser->insert($array['login_c'], $array['senha_c'], $array['email_c'])) {
                    $this->_redirect('index');
                } else {
                    $this->view->aviso = "Nome de usuario já existe";
                }
            } else {

                $this->view->aviso = "Senhas diferentes";
            }
        }
    }

}
