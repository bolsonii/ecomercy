<?php
include_once('../conexao.php');
session_start();

$retorno = [
    'status' => 'nok',
    'mensagem' => 'Ocorreu um erro',
    'data' => []
];

if (!isset($_GET['id']) || !isset($_GET['tipo'])) {
    $retorno['mensagem'] = 'É necessário informar um id e o tipo para exclusão';
    header('Content-type:application/json;charset:utf-8');
    echo json_encode($retorno);
    exit;
}

if (!isset($_SESSION['id_pessoa'])) {
    $retorno['mensagem'] = 'Usuário não autenticado.';
    header('Content-type:application/json;charset:utf-8');
    echo json_encode($retorno);
    exit;
}

$id_pessoa = $_SESSION['id_pessoa'];
$id_loja = (int)$_GET['id'];
$tipo = strtolower(trim($_GET['tipo'] ?? ''));

if ($tipo === 'compra') {
    $stmt = $conexao->prepare("DELETE FROM Loja_compra WHERE id_loja_compra = ? AND id_pessoa = ?");
} else if ($tipo === 'venda') {
    $stmt = $conexao->prepare("DELETE FROM Loja_vendas WHERE id_loja_venda = ? AND id_pessoa = ?");
} else {
    $retorno['mensagem'] = 'Tipo de loja inválido.';
    header('Content-type:application/json;charset:utf-8');
    echo json_encode($retorno);
    exit;
}

$stmt->bind_param("ii", $id_loja, $id_pessoa);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $retorno = [
        'status' => 'ok',
        'mensagem' => 'Registro excluido',
        'data' => []
    ];
} else {
    $retorno['mensagem'] = 'Registro não excluido ou você não tem permissão.';
}

$stmt->close();
$conexao->close();
header('Content-type:application/json;charset:utf-8');
echo json_encode($retorno);