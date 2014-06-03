<?php
$servidor = 'localhost';
$usuario = 'root';
$senha = 'A7cbdd82@1';

// Conecta-se ao banco de dados MySQL
$mysqli = new mysqli($servidor, $usuario, $senha);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
/* change character set to utf8 */
if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
}
$mysqli->select_db("alvo");
?>
