<?php
include_once('../conexao.php');
session_start();

$retorno = [
    'status' => 'nok',
    'mensagem' => 'Ocorreu um erro',
    'data' => []
];

// Seguir padrão do CRUD de itens: receber ID via GET
if (!isset($_GET['id'])) {
    $retorno = [
        'status' => 'nok',
        'mensagem' => 'Não posso alterar um registro sem um ID informado.',
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
$nome_loja = trim($_POST['nome_loja'] ?? '');
$id_itens = (int)($_POST['id_itens'] ?? 0);
$tipo = strtolower(trim($_POST['tipo'] ?? ''));

// Validação básica (mantendo validações similares ao padrão de itens)
if ($nome_loja === '' || $id_itens <= 0 || ($tipo !== 'compra' && $tipo !== 'venda')) {
    $retorno = [
        'status' => 'nok',
        'mensagem' => 'Dados inválidos ou incompletos.',
        'data' => []
    ];
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
    $retorno = [
        'status' => 'nok',
        'mensagem' => 'Falha ao alterar o registro ou nenhum dado foi alterado.',
        'data' => []
    ];
}

$stmt->close();
$conexao->close();

header('Content-type:application/json;charset:utf-8');
echo json_encode($retorno);
?>