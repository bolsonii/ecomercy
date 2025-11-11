<?php
include_once('../conexao.php');
session_start();

$retorno = [
    'status' => 'nok',
    'mensagem' => 'Ocorreu um erro',
    'data' => []
];

if (!isset($_GET['id'])) {
    $retorno['mensagem'] = 'Não posso alterar um registro sem um ID informado.';
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
$nome_loja = trim($_POST['nome_loja'] ?? '');
$id_itens = (int)($_POST['id_itens'] ?? 0);
$tipo = strtolower(trim($_POST['tipo'] ?? ''));

if (empty($nome_loja) || $id_itens <= 0 || ($tipo !== 'compra' && $tipo !== 'venda')) {
    $retorno['mensagem'] = 'Dados inválidos ou incompletos.';
    header('Content-type:application/json;charset:utf-8');
    echo json_encode($retorno);
    exit;
}

if ($tipo === 'compra') {
    $stmt = $conexao->prepare("UPDATE Loja_compra SET nome_loja = ?, id_itens = ? WHERE id_loja_compra = ? AND id_pessoa = ?");
} else {
    $stmt = $conexao->prepare("UPDATE Loja_vendas SET nome_loja = ?, id_itens = ? WHERE id_loja_venda = ? AND id_pessoa = ?");
}

$stmt->bind_param("siii", $nome_loja, $id_itens, $id_loja, $id_pessoa);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $retorno = [
        'status' => 'ok',
        'mensagem' => 'Registro alterado com sucesso.',
        'data' => []
    ];
} else {
    $retorno['mensagem'] = 'Falha ao alterar o registro ou nenhum dado foi alterado.';
}

$stmt->close();
$conexao->close();

header('Content-type:application/json;charset:utf-8');
echo json_encode($retorno);
