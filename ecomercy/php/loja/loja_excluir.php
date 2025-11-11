<?php
include_once('../conexao.php');
session_start();

$retorno = ['status' => 'nok', 'mensagem' => 'Ocorreu um erro'];

if (!isset($_GET['id'])) {
    $retorno['mensagem'] = 'É necessário informar um ID para exclusão';
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

$stmt = $conexao->prepare("DELETE FROM Loja WHERE id_loja = ? AND id_pessoa = ?");
$stmt->bind_param("ii", $id_loja, $id_pessoa);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $retorno = [
        'status' => 'ok',
        'mensagem' => 'Registro excluido'
    ];
} else {
    $retorno['mensagem'] = 'Registro não excluido ou você não tem permissão.';
}

$stmt->close();
$conexao->close();
header('Content-type:application/json;charset:utf-8');
echo json_encode($retorno);
