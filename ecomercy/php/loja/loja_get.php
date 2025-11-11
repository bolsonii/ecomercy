<?php
include_once('../conexao.php');
session_start();

$retorno = [
    'status' => 'nok',
    'mensagem' => 'Ocorreu um erro',
    'data' => []
];

// Padrão 1: Buscar um item específico (para edição)
// Desvio do padrão "Itens": precisamos do 'tipo' além do 'id'
if (isset($_GET['id']) && isset($_GET['tipo'])) {
    $id = (int)$_GET['id'];
    $tipo = strtolower(trim($_GET['tipo']));

    if ($tipo === 'compra') {
        $stmt = $conexao->prepare("SELECT id_loja_compra AS id_loja, nome_loja, id_pessoa, id_itens FROM Loja_compra WHERE id_loja_compra = ?");
    } else if ($tipo === 'venda') {
        $stmt = $conexao->prepare("SELECT id_loja_venda AS id_loja, nome_loja, id_pessoa, id_itens FROM Loja_vendas WHERE id_loja_venda = ?");
    } else {
        $retorno['mensagem'] = 'Tipo inválido';
        header('Content-type:application/json;charset:utf-8');
        echo json_encode($retorno);
        exit;
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $retorno = [
            'status' => 'ok',
            'mensagem' => 'Registro encontrado.',
            'data' => $resultado->fetch_all(MYSQLI_ASSOC)
        ];
    } else {
        $retorno['mensagem'] = 'Registro não encontrado';
    }

    $stmt->close();
    $conexao->close();
    header('Content-type:application/json;charset:utf-8');
    echo json_encode($retorno);
    exit;
}

// Padrão 2: Buscar todos os itens (para listagem)
// Lógica de 'lojas_listar.php'
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

$retorno = [
    'status' => 'ok',
    'mensagem' => 'Lojas listadas',
    'data' => $lojas
];

$stmt->close();
$conexao->close();
header('Content-type:application/json;charset:utf-8');
echo json_encode($retorno);
?>