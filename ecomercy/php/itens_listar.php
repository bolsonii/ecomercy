<?php
include_once('conexao.php');
$retorno = ['status' => 'ok', 'data' => []];

// Busca ID e Nome da tabela Itens
$resultado = $conexao->query("SELECT id_itens, nome_item FROM Itens ORDER BY nome_item");

if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $retorno['data'][] = $row;
    }
}

$conexao->close();
header("Content-type:application/json;charset:utf-8");
echo json_encode($retorno);
