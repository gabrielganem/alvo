<?php

class MensagemController extends Zend_Controller_Action
{

    private $modelMensagem = null;

    private $modelMensagem2 = null;
    
    private $modelMensagem3 = null;

    private $username = null;

    private $userid = null;
    
    private $projetoid = null;

    public function init()
    {
        $this->modelMensagem = new Application_Model_Mensagem();
        $this->modelMensagem2 = new Application_Model_Mensagem();
        $this->modelMensagem3 = new Application_Model_Mensagem();

        $identity = Zend_Auth::getInstance()->getIdentity();
        $this->username = $identity['login'];
        $this->userid = $identity['id_usuario'];
    }

    public function indexAction()
    {
        // action body
    }

    public function listarAction()
    {
       $this->view->listMessage = $this->modelMensagem->selectMensagemRemetente($this->userid);
       
    }
    
        public function recebidasAction()
    {
       $this->view->listMessage2 = $this->modelMensagem2->selectMensagemDestinatario($this->userid);
    }

    public function formAction()
    {
    	$data = $this->getRequest()->getPost();
    	$this->view->idproj = $data['fk_id_projeto'];
           //titulos em variaveis
        //titulo<title>
        $this->view->titulo = "Mensagem";
        //warning
        $this->view->warning = "";

        $array = $this->getAllParams();
        if (@$array['mensagem'] == "") {
            $this->view->warning = "Digite sua mensagem";
        }
        if ($array == null) {
            $array['mensagem'] = "";
        }
        if (@$array['mensagem'] != "") {
            //insert
            $this->modelMensagem3->insertMensagem($this->userid, $data['fk_id_projeto'], $array);
        }
    }

    public function listarRecebidasAction()
    {
         
    }
    public function mensagens_projeto()
    {	
    	//pegar o idprojeto vindo de anusio
    	$data = $this->getRequest()->getPost();
    	$this->view->idproj = $data['fk_id_projeto'];
    	
    	$this->view->listMessage = $this->modelMensagem->selectMensagemProjeto($data['fk_id_projeto']);
    }
    
    



}












