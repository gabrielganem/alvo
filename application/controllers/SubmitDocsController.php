<?php

class SubmitDocsController extends Zend_Controller_Action {

    private $username;
    private $userid;

    public function init() {
        $this->modelSub = new Application_Model_Submit();
        $identity = Zend_Auth::getInstance()->getIdentity();
        $this->username = $identity['login'];
        $this->userid = $identity['id_usuario'];
    }

    public function indexAction() {
        $data = $this->getRequest()->getPost();
        $this->view->idproj = $data['fk_id_projeto'];
        $this->view->docs = $this->modelSub->select($data['fk_id_projeto']);
    }

    public function uploadAction() {


        $data = $this->getRequest()->getPost();
        $this->view->idproj = $data['fk_id_projeto'];

        if ($data) {
            echo $data['nome'];


            if (!empty($_FILES)) {
                // Pasta onde o arquivo vai ser salvo
                $_UP['pasta'] = './uploads/';
                // Tamanho máximo do arquivo (em Bytes)
                $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
                // Array com as extensões permitidas
                $_UP['extensoes'] = array('jpg', 'png', 'gif');
                // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
                $_UP['renomeia'] = true;
                // Array com os tipos de erros de upload do PHP
                $_UP['erros'][0] = 'Não houve erro';
                $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
                $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
                $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
                $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

                // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
                if ($_FILES['upload']['error'] != 0) {
                    die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['upload']['error']]);
                    exit; // Para a execução do script
                }

                // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
                $name = $_FILES['upload']['name'];
                $end = explode('.', $name);
                $ext = end($end);
                $extensao = strtolower($ext);
                // Faz a verificação da extensão do arquivo
                if (array_search($extensao, $_UP['extensoes']) === false) {
                    echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
                }

                // Faz a verificação do tamanho do arquivo
                else if ($_UP['tamanho'] < $_FILES['upload']['size']) {
                    echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
                }
                // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
                else {
                    // Primeiro verifica se deve trocar o nome do arquivo
                    if ($_UP['renomeia'] == true) {
                        // Cria um nome baseado no UNIX TIMESTAMP atual 
                        $nome_final = time() . "." . $ext;
                    } else {
                        // Mantém o nome original do arquivo
                        $nome_final = $_FILES['upload']['name'];
                    }
                    $nome = $_POST['nome'];
                    // Depois verifica se é possível mover o arquivo para a pasta escolhida
                    if (move_uploaded_file($_FILES['upload']['tmp_name'], $_UP['pasta'] . $nome_final)) {


                        $data['titulo_documento'] = $nome_final;
                        $data['titulo_original'] = $name;


                        $this->modelSub->insert($data);
                        // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
                        
                        
                        $this->view->move = true;
                        
                        
                       
                    } else {
                        // Não foi possível fazer o upload, provavelmente a pasta está incorreta
                        echo "Não foi possível enviar o arquivo, tente novamente";
                         $this->view->move = false;
                    }
                }
            }
        }
    }

}
