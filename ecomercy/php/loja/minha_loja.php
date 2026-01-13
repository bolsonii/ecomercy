<?php
include_once('../conexao.php');
session_start();

$retorno = ['status' => 'nok', 'mensagem' => 'Erro ao buscar lojas'];

if (!isset($_SESSION['id_pessoa'])) {
    $retorno['mensagem'] = 'Usuário não autenticado.';
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
    exit;
}

$id_pessoa = $_SESSION['id_pessoa'];
$lojas_usuario = [];

$stmt = $conexao->prepare("
    SELECT l.*, i.nome as nome_item 
    FROM Loja l 
    LEFT JOIN Itens i ON l.id_itens = i.id 
    WHERE l.id_pessoa = ? 
    ORDER BY l.tipo_loja
");
$stmt->bind_param("i", $id_pessoa);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $lojas_usuario[] = $row;
    }
}
$stmt->close();

$retorno = [
    'status' => 'ok',
    'mensagem' => 'Lojas do usuário carregadas',
    'data' => $lojas_usuario
];

$conexao->close();
header("Content-type:application/json;charset:utf-8");
echo json_encode($retorno);

