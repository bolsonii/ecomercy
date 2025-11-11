<?php
include_once('../conexao.php');
session_start();

$retorno = ['status' => 'nok', 'mensagem' => 'Ocorreu um erro'];

// ... (Validação de Sessão e GET['id'] ... )

$id_pessoa = $_SESSION['id_pessoa'];
$id_loja = (int)$_GET['id'];
$nome_loja = trim($_POST['nome_loja'] ?? '');
$id_itens_input = (int)($_POST['id_itens'] ?? 0);

// Converte 0 (ou vazio) para NULL
$id_itens = ($id_itens_input > 0) ? $id_itens_input : NULL;

// Validação MODIFICADA
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
    $retorno = ['status' => 'ok', 'mensagem' => 'Registro alterado com sucesso.'];
} else {
    $retorno['mensagem'] = 'Falha ao alterar ou nenhum dado foi modificado.';
}

$stmt->close();
$conexao->close();

header('Content-type:application/json;charset:utf-8');
echo json_encode($retorno);
