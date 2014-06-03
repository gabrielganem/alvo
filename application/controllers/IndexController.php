<?php

class IndexController extends Zend_Controller_Action {

    private $modelUser = null;

    public function init() {
        $this->modelUser = new Application_Model_Usuario();
        $this->_helper->layout->disableLayout();
        $this->_helper->layout->setLayout('login');
    }

    public function indexAction() {
        $array = $this->getAllParams();
        if (array_key_exists('nome_usuario', $array)) {
            if ($this->modelUser->loguin($array['nome_usuario'], $array['senha'])) {
                $this->_redirect('projeto');
            } else {
                $this->view->resultlogin = "usuario e senha nao existe";
            }
            //$this->modelUser->insert($array['nome_usuario'], $array['senha']);
        }
    }

    public function cadastroAction() {
        $array = $this->getAllParams();
        if (array_key_exists('nome_usuario', $array)) {
            if ($array['nome_usuario'] == "") {
                $this->view->aviso = "insira um nome de usuario valido";
                return;
            }

            if ($array['senha1'] == $array['senha2']) {
                if ($this->modelUser->insert($array['nome_usuario'], $array['senha1'])) {
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
