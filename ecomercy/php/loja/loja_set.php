<?php
include_once('../conexao.php');
session_start();

$retorno = ['status' => 'nok', 'mensagem' => 'Ocorreu um erro'];

// Validar sessão
if (!isset($_SESSION['id_pessoa'])) {
    $retorno['mensagem'] = 'Usuário não autenticado.';
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
    exit;
}

$id_pessoa = $_SESSION['id_pessoa'];
$nome_loja = $_POST['nome_loja'];
$id_itens = (int)$_POST['id_itens']; // O ID do item que a loja negocia
$tipo = $_POST['tipo']; // 'compra' ou 'venda'

// Validação básica
if (empty($nome_loja) || empty($id_itens) || empty($tipo)) {
    $retorno['mensagem'] = 'Todos os campos são obrigatórios.';
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
    exit;
}

// Validar ID do item
if (!is_numeric($id_itens) || $id_itens <= 0) {
    $retorno['mensagem'] = 'ID do item inválido.';
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
    exit;
}

$check = $conexao->prepare("SELECT id_itens FROM Itens WHERE id_itens = ?");
$check->bind_param("i", $id_itens);
$check->execute();
if ($check->get_result()->num_rows == 0) {
    $retorno['mensagem'] = 'O item selecionado não existe.';
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
    exit;
}
$check->close();

// Valida se o usuário já tem uma loja desse tipo
if ($tipo == 'compra') {
    $check = $conexao->prepare("SELECT id_loja_compra FROM Loja_compra WHERE id_pessoa = ?");
} else if ($tipo == 'venda') {
    $check = $conexao->prepare("SELECT id_loja_venda FROM Loja_vendas WHERE id_pessoa = ?");
}
$check->bind_param("i", $id_pessoa);
$check->execute();
if ($check->get_result()->num_rows > 0) {
    $retorno['mensagem'] = 'Você já possui uma loja deste tipo.';
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
    exit;
}
$check->close();

if ($tipo == 'compra') {
    $stmt = $conexao->prepare("INSERT INTO Loja_compra(nome_loja, id_pessoa, id_itens) VALUES(?, ?, ?)");
} else if ($tipo == 'venda') {
    $stmt = $conexao->prepare("INSERT INTO Loja_vendas(nome_loja, id_pessoa, id_itens) VALUES(?, ?, ?)");
} else {
    $retorno['mensagem'] = 'Tipo de loja inválido.';
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
    exit;
}

$stmt->bind_param("sii", $nome_loja, $id_pessoa, $id_itens);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $retorno = [
        'status' => 'ok',
        'mensagem' => 'Loja criada com sucesso!',
        'data' => ['id' => $stmt->insert_id]
    ];
} else {
    $retorno['mensagem'] = 'Falha ao criar a loja: ' . $stmt->error;
}

$stmt->close();
$conexao->close();

header("Content-type:application/json;charset:utf-8");
echo json_encode($retorno);
