<?php

require_once "conexao.php";

$dadosInsercao = [
    ['tipo' => 'VALOR MÍNIMO', 'valor' => 200.00],
    ['tipo' => 'VALOR MÍNIMO', 'valor' => 100.00],
    ['tipo' => 'VALOR MÉDIO', 'valor' => 1300.00],
    ['tipo' => 'VALOR MÉDIO', 'valor' => 1200.00],
    ['tipo' => 'VALOR MÉDIO', 'valor' => 1100.00],
    ['tipo' => 'VALOR MÁXIMO', 'valor' => 2000.00],
    ['tipo' => 'VALOR MÁXIMO', 'valor' => 2100.00],
    ['tipo' => 'VALOR NORMAL', 'valor' => 1000.00],
    ['tipo' => 'VALOR NORMAL', 'valor' => 900.00],
    ['tipo' => 'VALOR NORMAL', 'valor' => 800.00],
];

$conexao = novaConexao();

foreach ($dadosInsercao as $parcela) {
    $sql = "INSERT INTO parcelas (tipo, valor) VALUES (?,?)";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('sd', $parcela['tipo'], $parcela['valor']);
    
    if ($stmt->execute()) {
        echo "Sucesso";
    } else {
        echo "Erro: ". $stmt->error;
    }
}

$stmt->close();
$conexao->close();

?>
