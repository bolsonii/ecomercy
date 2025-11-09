<?php
include_once('../conexao.php'); // Sua conexão com mysqli
$retorno = ['status' => 'nok', 'mensagem' => 'Ocorreu um erro'];

// Validar sessão
if (!isset($_SESSION['id_pessoa'])) {
    $retorno['mensagem'] = 'Usuário não autenticado.';
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
    echo json_encode($retorno);
    exit;
}

// Validar ID do item
if (!is_numeric($id_itens) || $id_itens <= 0) {
    $retorno['mensagem'] = 'ID do item inválido.';
    echo json_encode($retorno);
    exit;
}

// Verificar se o item existe (assumindo que existe uma tabela Itens)
$check = $conexao->prepare("SELECT id_item FROM Itens WHERE id_item = ?");
$check->bind_param("i", $id_itens);
$check->execute();
if ($check->get_result()->num_rows == 0) {
    $retorno['mensagem'] = 'O item selecionado não existe.';
    echo json_encode($retorno);
    exit;
}
$check->close();

// Valida se o usuário já tem uma loja desse tipo
if ($tipo == 'compra') {
    $check = $conexao->prepare("SELECT id_loja_compra FROM Loja_compra WHERE id_pessoa = ?");
} else {
    $check = $conexao->prepare("SELECT id_loja_venda FROM Loja_venda WHERE id_pessoa = ?");
}
$check->bind_param("i", $id_pessoa);
$check->execute();
if ($check->get_result()->num_rows > 0) {
    $retorno['mensagem'] = 'Você já possui uma loja deste tipo.';
    echo json_encode($retorno);
    exit;
}
$check->close();

// TODO: Seria bom verificar se o usuário já tem uma loja desse tipo, se a regra for de apenas uma.

if ($tipo == 'compra') {
    $stmt = $conexao->prepare("INSERT INTO
     Loja_compra(nome_loja, id_pessoa, id_itens) VALUES(?, ?, ?)");
} else if ($tipo == 'venda') {
    $stmt = $conexao->prepare("INSERT INTO
     Loja_vendas(nome_loja, id_pessoa, id_itens) VALUES(?, ?, ?)");
} else {
    $retorno['mensagem'] = 'Tipo de loja inválido.';
    echo json_encode($retorno);
    exit;
}

$stmt->bind_param("sii", $nome_loja, $id_pessoa, $id_itens);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $retorno = [
        'status' => 'ok',
        'mensagem' => 'Loja (' . $tipo . ') criada com sucesso!',
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