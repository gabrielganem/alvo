<?php

class Application_Model_Submit {

    public function select($id_projeto) {

        $dbtableUP = new Application_Model_DbTable_Submit();
        $query1 = $dbtableUP->select()->from($dbtableUP)->where('fk_id_projeto = ?', $id_projeto);
        $arrayDoc = $dbtableUP->fetchAll($query1)->toArray();

        return $arrayDoc;
    }

    public function insert($array) {
        //insere o novo documento
        $dbTableSub = new Application_Model_DbTable_Submit();
        $query = $dbTableSub->insert(array('titulo_documento' => $array['titulo_documento'],
            'titulo_original' => $array['titulo_original'],
            'fk_id_projeto' => $array['fk_id_projeto']
                )
        );
    }

}
