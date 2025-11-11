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
$tipo_loja = (int)($_POST['tipo_loja'] ?? 0); // 1 para Compra, 2 para Venda

if (empty($nome_loja) || $id_itens <= 0 || !in_array($tipo_loja, [1, 2])) {
    $retorno['mensagem'] = 'Dados inválidos (Nome, Item ou Tipo).';
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
    exit;
}

// Valida se o usuário já tem uma loja desse tipo
$check = $conexao->prepare("SELECT id_loja FROM Loja WHERE id_pessoa = ? AND tipo_loja = ?");
$check->bind_param("ii", $id_pessoa, $tipo_loja);
$check->execute();
if ($check->get_result()->num_rows > 0) {
    $retorno['mensagem'] = 'Você já possui uma loja deste tipo.';
    $check->close();
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
    exit;
}
$check->close();

// Inserção do sqll
$stmt = $conexao->prepare("INSERT INTO Loja(nome_loja, id_pessoa, id_itens, tipo_loja) VALUES(?, ?, ?, ?)");
$stmt->bind_param("siii", $nome_loja, $id_pessoa, $id_itens, $tipo_loja);
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
