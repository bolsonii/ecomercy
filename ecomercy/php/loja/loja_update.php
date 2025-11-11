<?php
include_once('../conexao.php');
session_start();

$retorno = ['status' => 'nok', 'mensagem' => 'Ocorreu um erro'];

// Validação de sessão
if (!isset($_SESSION['id_pessoa'])) {
    $retorno['mensagem'] = 'Usuário não autenticado.';
    header('Content-type:application/json;charset:utf-8');
    echo json_encode($retorno);
    exit;
}

// Validação do ID
if (!isset($_GET['id'])) {
    $retorno['mensagem'] = 'ID da loja não informado.';
    header('Content-type:application/json;charset:utf-8');
    echo json_encode($retorno);
    exit;
}

$id_pessoa = $_SESSION['id_pessoa'];
$id_loja = (int)$_GET['id'];
$nome_loja = trim($_POST['nome_loja'] ?? '');
$id_itens_input = (int)($_POST['id_itens'] ?? 0);

// Converte 0 (ou vazio) para NULL
$id_itens = ($id_itens_input > 0) ? $id_itens_input : NULL;

// Validação
if (empty($nome_loja)) {
    $retorno['mensagem'] = 'O nome da loja não pode ser vazio.';
    header('Content-type:application/json;charset:utf-8');
    echo json_encode($retorno);
    exit;
}

$stmt = $conexao->prepare("UPDATE Loja SET nome_loja = ?, id_itens = ? WHERE id_loja = ? AND id_pessoa = ?");
$stmt->bind_param("siii", $nome_loja, $id_itens, $id_loja, $id_pessoa);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $retorno = ['status' => 'ok', 'mensagem' => 'Loja atualizada com sucesso!'];
} else {
    $retorno['mensagem'] = 'Falha ao atualizar a loja ou nenhum dado foi modificado.';
}

$stmt->close();
$conexao->close();

header('Content-type:application/json;charset:utf-8');
echo json_encode($retorno);
