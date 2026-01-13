<?php
ob_clean();
header("Content-type:application/json;charset:utf-8");
include_once('./conexao.php');

if (!isset($conexao) || $conexao->connect_error) {
    http_response_code(500);
    die(json_encode(['status' => 'erro', 'mensagem' => 'Erro de conexão com banco de dados']));
}

$retorno = ['status' => 'ok', 'data' => []];

$sql = "SELECT id AS id_itens, nome AS nome_item FROM Itens ORDER BY nome";
$resultado = $conexao->query($sql);

if ($resultado === false) {
    $retorno['status'] = 'erro';
    $retorno['mensagem'] = 'Erro na consulta: ' . $conexao->error;
} else if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $retorno['data'][] = $row;
    }
}

$conexao->close();
echo json_encode($retorno);

