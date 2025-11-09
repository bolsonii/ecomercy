<?php
include_once('../conexao.php');
$retorno = ['status' => 'ok', 'mensagem' => 'Lojas listadas', 'data' => []];

// Pega o ID do usuário logado, ou 0 se não estiver logado
$id_pessoa_logada = $_SESSION['id_pessoa'] ?? 0;

$sql = "(
    SELECT id_loja_compra as id_loja, nome_loja, id_pessoa, id_itens, 'Compra' as tipo 
    FROM Loja_compra 
    WHERE id_pessoa != ?
) UNION ALL (
    SELECT id_loja_venda as id_loja, nome_loja, id_pessoa, id_itens, 'Venda' as tipo 
    FROM Loja_vendas 
    WHERE id_pessoa != ?
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
header("Content-type:application/json;charset:utf-8");
echo json_encode($retorno);
?>