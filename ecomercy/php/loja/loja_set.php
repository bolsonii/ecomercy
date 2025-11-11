<?php
include_once('../conexao.php');
session_start();

$retorno = ['status' => 'nok', 'mensagem' => 'Ocorreu um erro'];

if (!isset($_SESSION['id_pessoa'])) {
    $retorno['mensagem'] = 'Usuário não autenticado.';
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
    exit;
}

$id_pessoa = $_SESSION['id_pessoa'];
$nome_loja = $_POST['nome_loja'] ?? '';
$id_itens = (int)($_POST['id_itens'] ?? 0);
$tipo = $_POST['tipo'] ?? '';

if (empty($nome_loja) || $id_itens <= 0 || empty($tipo)) {
    $retorno['mensagem'] = 'Todos os campos são obrigatórios.';
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
    exit;
}

$check_item = $conexao->prepare("SELECT id_itens FROM Itens WHERE id_itens = ?");
$check_item->bind_param("i", $id_itens);
$check_item->execute();
if ($check_item->get_result()->num_rows == 0) {
    $retorno['mensagem'] = 'O item selecionado não existe.';
    $check_item->close();
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
    exit;
}
$check_item->close();
$tabela_check = ($tipo == 'compra') ? 'Loja_compra' : 'Loja_vendas';
$coluna_id = ($tipo == 'compra') ? 'id_loja_compra' : 'id_loja_venda';

$check_loja = $conexao->prepare("SELECT $coluna_id FROM $tabela_check WHERE id_pessoa = ?");
$check_loja->bind_param("i", $id_pessoa);
$check_loja->execute();
if ($check_loja->get_result()->num_rows > 0) {
    $retorno['mensagem'] = 'Você já possui uma loja deste tipo.';
    $check_loja->close();
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
    exit;
}
$check_loja->close();

// Inserção
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
?>