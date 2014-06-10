<?php

//anusio
class ProjetoController extends Zend_Controller_Action {

    private $modelPro;
    private $username;
    private $userid;

    /**
     * inicializa as variaveis que vao ser usadas no escopo projetoControler
     */
    public function init() {
        $this->modelMensagem = new Application_Model_Mensagem();


        $this->modelPro = new Application_Model_Projeto();
        $identity = Zend_Auth::getInstance()->getIdentity();
                
        if ($identity != null) {
            $this->username = $identity['login'];
            $this->userid = $identity['id_usuario'];
        } else {
            $this->_helper->redirector('Index','index');        
        }
    }

    /**
     * action de exibção de projetos
     */
    public function indexAction() {
        //envia para a view a tabela de projetos do usuario
        //cargo = admin normal etc... depois ver isto
        $this->view->seldproj = $this->modelPro->select($this->userid);
    }

    /**
     * action de criar projetos
     */
    public function criarprojetoAction() {
        //warning
        $this->view->warning = "";

        $array = $this->getAllParams();
        if (@$array['nome_projeto'] == "") {
            $this->view->warning = "Digite um nome para o seu projeto";
        }
        if ($array == null) {
            $array['nome_projeto'] = "";
        }
        if (@$array['nome_projeto'] != "") {
            //insert
            $this->modelPro->insert($this->userid, $array);
        }
    }

    /**
     * action de visualizar projeto
     */
    public function visualizarprojetoAction() {
        $array = $this->getAllParams();
        if ($array == null) {
            $this->_redirect('projeto');
        }
        //titulos em variaveis
        //titulo<title>
        $this->view->titulo = "visualizar projeto";
        //<h1>
        $this->view->titulo1 = "Projeto " . @$array['nome_projeto'];
        //warning
        $this->view->warning = "";

        $array2 = $this->modelPro->selectusers(@$array['id_projeto']);

        $this->view->participantes = $array2;

        if (array_key_exists('id_projeto', $array)) {
            $this->view->idproj = @$array['id_projeto'];

            $this->view->nmproj = @$array['nome_projeto'];
        }
        $this->view->descricao = $this->modelPro->selectDescricao(@$array['id_projeto']);
        $this->view->listMessage = $this->modelMensagem->selectMensagemDestinatario($this->userid);
        $this->view->userMessage = $this->modelPro->selectUsers(@$array['id_projeto']);
    }

    /**
     * action de adicionar projeto
     */
    public function adicionarusuarioprojetoAction() {
        $array = $this->getAllParams();
        if ($array == null) {
            $this->redirect('projeto');
        }
        if (array_key_exists('id_projeto', $array)) {
            $this->view->idproj = @$array['id_projeto'];

            $this->view->nmproj = @$array['nome_projeto'];
        }
        //titulos em variaveis
        //titulo<title>
        $this->view->titulo = "Adicionar usuarios ao projeto " . @$array['nome_projeto'];
        //<h1>
        $this->view->titulo1 = "Adicionar usuarios ao projeto " . @$array['nome_projeto'];
        //warning
        $this->view->warning = "";
        if (array_key_exists('nome_usuario', $array)) {
            $this->view->warning = $this->modelPro->insertuser($array['nome_usuario'], $array['id_projeto']);
        }
    }

}
