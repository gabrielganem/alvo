<?php

class Application_Model_Usuario {

    /**
     * verifica se existe um usuario e a senha (criptografada em md5) no banco de dados
     * retorna true se sim e false senao
     * @param type $nome
     * @param type $senha
     * @return boolean
     */
    public function loguin($nome, $senha) {
        if ($nome == "") {
            return false;
        }//Obter o objeto do adaptador para autenticar usando banco de dados
        $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

        //Seta qual tabela e colunas procurar o usuário
        $authAdapter->setTableName('usuario')
                ->setIdentityColumn('login')
                ->setCredentialColumn('senha');
        //Seta as credenciais com dados vindos do formulário de login
        $authAdapter->setIdentity($nome)
                ->setCredential($senha)
                ->setCredentialTreatment('MD5(?)');
        //Realiza autenticação
        $result = $authAdapter->authenticate();
        //Verifica se a autenticação foi válida
        if ($result->isValid()) {
            //Obtém dados do usuário
            $data = $authAdapter->getResultRowObject();
            $usuario = (array) $data;
            //Armazena seus dados na sessão
            Zend_Auth::getInstance()->getStorage()->write($usuario);
            //Redireciona para o Index
            return true;
        } else {
            return false;
        }
    }

    /**
     * registra um usuario e sua senha(criptografada) no banco
     * retorna uma string de aviso
     * @param type $nome
     * @param type $senha
     * @return string
     */
    public function insert($nome, $senha) {
        if ($nome == "") {
            return "digite o nome do usuario a ser inserido.";
        }
        $dbTableUse = new Application_Model_DbTable_Usuario();
        //lembrar de setar unic no banco
        $query = $dbTableUse->insert(array('login' => $nome, 'senha' => md5($senha)));

        if ($query == null) {
            return "login existente";
        }
        return "Bem-vindo a ALVO";
    }
    /**
     * executa o logout
     */
    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_redirect('/user');
    }

    
}
