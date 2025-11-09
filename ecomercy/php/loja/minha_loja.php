<?php
include_once('../conexao.php');
$retorno = ['status' => 'nok', 'mensagem' => 'Erro ao buscar lojas', 'data' => []];

if (!isset($_SESSION['id_pessoa'])) {
    $retorno['mensagem'] = 'Usuário não autenticado.';
    echo json_encode($retorno);
    exit;
}

$id_pessoa = $_SESSION['id_pessoa'];

$loja_compra = null;
$loja_venda = null;

// Busca loja de compra
$stmt_compra = $conexao->prepare("SELECT id_loja_compra, nome_loja,
 id_itens FROM Loja_compra WHERE id_pessoa = ? LIMIT 1");
$stmt_compra->bind_param("i", $id_pessoa);
$stmt_compra->execute();
$resultado_compra = $stmt_compra->get_result();
if ($resultado_compra->num_rows > 0) {
    $loja_compra = $resultado_compra->fetch_assoc();
}
$stmt_compra->close();

// Busca loja de venda
$stmt_venda = $conexao->prepare("SELECT id_loja_venda, nome_loja,
 id_itens FROM Loja_vendas WHERE id_pessoa = ? LIMIT 1");
$stmt_venda->bind_param("i", $id_pessoa);
$stmt_venda->execute();
$resultado_venda = $stmt_venda->get_result();
if ($resultado_venda->num_rows > 0) {
    $loja_venda = $resultado_venda->fetch_assoc();
}
$stmt_venda->close();

$retorno = [
    'status' => 'ok',
    'mensagem' => 'Lojas do usuário carregadas',
    'data' => [
        'compra' => $loja_compra, // Será null se não existir
        'venda' => $loja_venda   // Será null se não existir
    ]
];

$conexao->close();
header("Content-type:application/json;charset:utf-8");
echo json_encode($retorno);
?>