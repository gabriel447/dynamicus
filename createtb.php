<?php

require_once "conexao.php";

$sql = "CREATE TABLE IF NOT EXISTS parcelas(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(100) NOT NULL,
    valor FLOAT
)"; 

$conexao = novaConexao();
$resultado = $conexao->query($sql);

if($resultado) {
    echo "Sucesso :)";
}else {
    echo "Erro: . $conexao->error";
}

$conexao->close();

?>