<?php

class Application_Model_Mensagem {

    public function selectMensagemRemetente($idusuario) {
        $dbTableMensagem = new Application_Model_DbTable_Mensagem();
        $query = $dbTableMensagem->select()->from($dbTableMensagem)->where('fk_remetente = ?', $idusuario);
        $array = $dbTableMensagem->fetchAll($query)->toArray();
        return $array;
    }

    public function selectMensagemDestinatario($idusuario) {
        $dbTableMensagem2 = new Application_Model_DbTable_Mensagem();
        $query1 = $dbTableMensagem2->select()->from($dbTableMensagem2)->where('fk_destinatario = ?', $idusuario);
        $array1 = $dbTableMensagem2->fetchAll($query1)->toArray();
        return $array1;
    }
    
      public function selectMensagemProjeto($idprojeto) {
        $dbTableProjeto = new Application_Model_DbTable_Mensagem();
        $query2 = $dbTableProjeto->select()->from($dbTableProjeto)->where('fk_id_projeto = ?', $idprojeto);
        $array2 = $dbTableProjeto->fetchAll($query2)->toArray();
        return $array2;
    }
    
        public function insertMensagem($idusuario, $idprojeto, $array) {
        //insere nova mensagem
        $dbTableMensagem3 = new Application_Model_DbTable_Mensagem();
        $dbTableMensagem3->insert(array('mensagem' => $array['mensagem'],
            'fk_destinatario' => $array['destinatario'],
            'fk_remetente' => $idusuario,
            'fk_id_projeto' => $idprojeto));
    }




}
