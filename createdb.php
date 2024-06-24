<?php

require_once "conexao.php";

$conexao = novaConexao(null);
$sql = 'CREATE DATABASE IF NOT EXISTS dynamicus';

$resultado = $conexao->query($sql);

if($resultado) {
    echo "Sucesso :)";
}else {
    echo "Erro: . $conexao->error";
}

$conexao->close();

?>