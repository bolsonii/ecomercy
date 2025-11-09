<?php
include_once('../conexao.php');
$retorno = ['status' => 'nok', 'mensagem' => 'Ocorreu um erro'];

if (!isset($_SESSION['id_pessoa'])) {
    $retorno['mensagem'] = 'Usuário não autenticado.';
    echo json_encode($retorno);
    exit;
}

$id_pessoa = $_SESSION['id_pessoa'];
$id_loja = (int)$_POST['id_loja']; // id_loja_compra OU id_loja_venda
$nome_loja = $_POST['nome_loja'];
$id_itens = (int)$_POST['id_itens'];
$tipo = $_POST['tipo']; // 'compra' ou 'venda'

if ($tipo == 'compra') {
    $stmt = $conexao->prepare("UPDATE Loja_compra
     SET nome_loja = ?, id_itens = ? WHERE id_loja_compra = ? AND id_pessoa = ?");
} else if ($tipo == 'venda') {
    $stmt = $conexao->prepare("UPDATE Loja_vendas
     SET nome_loja = ?, id_itens = ? WHERE id_loja_venda = ? AND id_pessoa = ?");
} else {
    $retorno['mensagem'] = 'Tipo de loja inválido.';
    echo json_encode($retorno);
    exit;
}

$stmt->bind_param("siii", $nome_loja, $id_itens, $id_loja, $id_pessoa);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $retorno = ['status' => 'ok', 'mensagem' => 'Loja atualizada com sucesso!'];
} else {
    $retorno['mensagem'] = 'Falha ao atualizar a loja ou nenhum dado foi alterado.';
}

$stmt->close();
$conexao->close();
header("Content-type:application/json;charset:utf-8");
echo json_encode($retorno);
?>