<?php

class Application_Model_Projeto {

    /**
     * seleciona os projetos que o usuario participa
     * retorna uma array de array de tuplas
     * @param type $userid
     * @param type $cargo
     * @return array(array())
     */
    public function select($userid, $cargo = null) {
        $array = null;
        //seleciona todas as fks dos projetos do usuario
        $dbtableUP = new Application_Model_DbTable_ProjetoUsuario();
        if ($cargo == null) {
            $query1 = $dbtableUP->select()->from($dbtableUP)->where('fk_id_usuario = ?', $userid);
        } else {
            $query1 = $dbtableUP->select()->from($dbtableUP)->where('fk_id_usuario = ?', $userid)->where('fk_id_cargo = ?', $cargo);
        }
        /* @var $arrayUserProj type */
        $arrayUserProj = $dbtableUP->fetchAll($query1)->toArray();
        //seleciona os projetos do usuario
        if ($arrayUserProj != null) {
            $dbTablePro = new Application_Model_DbTable_Projeto();
            foreach ($arrayUserProj as $uspr) {
                $query = $dbTablePro->select()->from($dbTablePro)->where('id_projeto = ?', $uspr['fk_id_projeto']);
                if ($array == null) {
                    $array = array($dbTablePro->fetchAll($query)->toArray());
                } else {
                    array_push($array, $dbTablePro->fetchAll($query)->toArray());
                }
            }
        }
        //
        return $array;
    }
    /**
     * cria um projeto onde o usuario é o criador/gestor
     * array deve conter os valores nome_projeto e descricao
     * @param type $userid
     * @param type $array
     */
    public function insert($userid, $array) {
        //modifique aqui a id cargo que seja admin gestor ou o que seja
        $idcargo = 1;
        //insere o novo projeto
        $dbTablePro = new Application_Model_DbTable_Projeto();
        $query = $dbTablePro->insert(array('nome_projeto' => $array['nome_projeto'],
            'descricao_projeto' => $array['descricao'],
            'progresso_projeto' => "0"));
        //query é tbm o last id
        //insere a relação n-n
        $dbtableUP = new Application_Model_DbTable_ProjetoUsuario();
        $query1 = $dbtableUP->insert(array('fk_id_usuario' => $userid,
            'fk_id_projeto' => $query,
            'fk_id_cargo' => $idcargo));
    }
    /**
     * seleciona a descricao do projeto
     * @param type $idprojeto
     * @return type
     */
    public function selectDescricao($idprojeto) {
        $dbTablePro = new Application_Model_DbTable_Projeto();
        $query = $dbTablePro->select()->from($dbTablePro)->where('id_projeto = ?', $idprojeto);
        $array = $dbTablePro->fetchAll($query)->toArray();
        return $array[0]['descricao_projeto'];
    }
    /**
     * seleciona os usuarios participantes do projeto
     * @param type $idprojeto
     * @return type
     */
    public function selectusers($idprojeto) {
        $array = null;
        //seleciona todos os participantes do projeto
        $dbtableUP = new Application_Model_DbTable_ProjetoUsuario();

        $query1 = $dbtableUP->select()->from($dbtableUP)->where('fk_id_projeto = ?', $idprojeto);

        /* @var $arrayUserProj type */
        $arrayUserProj = $dbtableUP->fetchAll($query1)->toArray();
        //seleciona da tabela de usuario os usuarios participantes

        if ($arrayUserProj != null) {
            $dbTableUse = new Application_Model_DbTable_Usuario();
            foreach ($arrayUserProj as $uspr) {
                $query = $dbTableUse->select()->from($dbTableUse)->where('id_usuario = ?', $uspr['fk_id_usuario']);
                if ($array == null) {
                    $array = array($dbTableUse->fetchAll($query)->toArray());
                } else {
                    array_push($array, $dbTableUse->fetchAll($query)->toArray());
                }
            }
        }
        //
        return $array;
    }
    /**
     * insere os usuarios num projeto
     * retorna strings de aviso
     * @param type $username
     * @param type $idprojeto
     * @return string
     */
    public function insertuser($username, $idprojeto) {
        $idcargo = 2;
        if ($username == "") {
            return "digite o nome do usuario a ser inserido.";
        }
        $dbTableUse = new Application_Model_DbTable_Usuario();
        $query = $dbTableUse->select()->from($dbTableUse)->where('login = ?', $username);
        $array = $dbTableUse->fetchAll($query)->toArray();
        if ($array == null) {
            return "usuario " . $username . " ainda nao foi cadastrado em ALVO.";
        }
        $dbprojus = new Application_Model_DbTable_ProjetoUsuario();
        $query2 = $dbprojus->select()->from($dbprojus)->where('fk_id_projeto = ?', $idprojeto)->where('fk_id_usuario = ?', $array[0]['id_usuario']);

        $array2 = $dbprojus->fetchAll($query2)->toArray();

        if ($array2 != null) {
            return $username . " ja foi cadastrado no projeto.";
        }

        //seleciona todos os participantes do projeto
        $dbtableUP = new Application_Model_DbTable_ProjetoUsuario();
        $dbtableUP->insert(array('fk_id_usuario' => $array[0]['id_usuario'],
            'fk_id_projeto' => $idprojeto,
            'fk_id_cargo' => $idcargo));
        return $username . " foi adicionado ao projeto.";
    }

}
