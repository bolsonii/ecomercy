<?php
include_once('../conexao.php');
$retorno = ['status' => 'nok', 'mensagem' => 'Ocorreu um erro'];

if (!isset($_SESSION['id_pessoa'])) {
    $retorno['mensagem'] = 'Usuário não autenticado.';
    echo json_encode($retorno);
    exit;
}

$id_pessoa = $_SESSION['id_pessoa'];
$id_loja = (int)$_POST['id_loja'];
$tipo = $_POST['tipo']; // 'compra' ou 'venda'

if ($tipo == 'compra') {
    $stmt = $conexao->prepare("DELETE FROM Loja_compra WHERE
     id_loja_compra = ? AND id_pessoa = ?");
} else if ($tipo == 'venda') {
    $stmt = $conexao->prepare("DELETE FROM Loja_vendas WHERE
     id_loja_venda = ? AND id_pessoa = ?");
} else {
    $retorno['mensagem'] = 'Tipo de loja inválido.';
    echo json_encode($retorno);
    exit;
}

$stmt->bind_param("ii", $id_loja, $id_pessoa);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $retorno = ['status' => 'ok', 'mensagem' => 'Loja excluída com sucesso!'];
} else {
    $retorno['mensagem'] = 'Falha ao excluir a loja. Verifique se você é o proprietário.';
}

$stmt->close();
$conexao->close();
header("Content-type:application/json;charset:utf-8");
echo json_encode($retorno);
?>