<?php
include_once('../conexao.php');
session_start();

$retorno = ['status' => 'ok', 'mensagem' => 'Lojas listadas', 'data' => []];

// Pega o ID do usuário logado, ou 0 se não estiver logado
$id_pessoa_logada = $_SESSION['id_pessoa'] ?? 0;

$sql = "(
    SELECT lc.id_loja_compra as id_loja, lc.nome_loja, lc.id_pessoa, lc.id_itens, i.nome as nome_item, 'Compra' as tipo 
    FROM Loja_compra lc
    LEFT JOIN Itens i ON lc.id_itens = i.id
    WHERE lc.id_pessoa != ?
) UNION ALL (
    SELECT lv.id_loja_venda as id_loja, lv.nome_loja, lv.id_pessoa, lv.id_itens, i.nome as nome_item, 'Venda' as tipo 
    FROM Loja_vendas lv
    LEFT JOIN Itens i ON lv.id_itens = i.id
    WHERE lv.id_pessoa != ?
)";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("ii", $id_pessoa_logada, $id_pessoa_logada);
$stmt->execute();
$resultado = $stmt->get_result();

$lojas = [];
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $lojas[] = $row;
    }
}

$retorno['data'] = $lojas;

 $stmt->close();
 $conexao->close();
 header('Content-Type: application/json; charset=utf-8');
 echo json_encode($retorno);
?>
