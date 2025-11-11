<?php
include_once('../conexao.php');
session_start();

$retorno = [
    'status' => 'nok',
    'mensagem' => 'Ocorreu um erro',
    'data' => []
];

// Seguir padrão do CRUD de itens: receber ID via GET
if (!isset($_GET['id']) || !isset($_GET['tipo'])) {
    $retorno = [
        'status' => 'nok',
        'mensagem' => 'É necessário informar um id e o tipo para exclusão',
        'data' => []
    ];
    header('Content-type:application/json;charset:utf-8');
    echo json_encode($retorno);
    exit;
}

// Valida sessão
if (!isset($_SESSION['id_pessoa'])) {
    $retorno['mensagem'] = 'Usuário não autenticado.';
    header('Content-type:application/json;charset:utf-8');
    echo json_encode($retorno);
    exit;
}

$id_pessoa = $_SESSION['id_pessoa'];
$id_loja = (int)$_GET['id'];
$tipo = strtolower(trim($_GET['tipo'] ?? ''));

if ($tipo !== 'compra' && $tipo !== 'venda') {
    $retorno = [
        'status' => 'nok',
        'mensagem' => 'Tipo de loja inválido.',
        'data' => []
    ];
    header('Content-type:application/json;charset:utf-8');
    echo json_encode($retorno);
    exit;
}

if ($tipo === 'compra') {
    $stmt = $conexao->prepare("DELETE FROM Loja_compra WHERE id_loja_compra = ? AND id_pessoa = ?");
} else {
    $stmt = $conexao->prepare("DELETE FROM Loja_vendas WHERE id_loja_venda = ? AND id_pessoa = ?");
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
    $retorno = [
        'status' => 'nok',
        'mensagem' => 'Registro não excluido ou você não tem permissão.',
        'data' => []
    ];
}

$stmt->close();
$conexao->close();
header('Content-type:application/json;charset:utf-8');
echo json_encode($retorno);
?>