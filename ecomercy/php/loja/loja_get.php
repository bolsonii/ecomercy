<?php
include_once('../conexao.php');

// Padrão de retorno idêntico aos arquivos de itens
 $retorno = [
    'status' => '',
    'mensagem' => '',
    'data' => []
];

// Se foi passado id e tipo, retorna um registro específico
if (isset($_GET['id']) && isset($_GET['tipo'])) {
    $id = (int)$_GET['id'];
    $tipo = strtolower(trim($_GET['tipo']));

    if ($tipo === 'compra') {
        $stmt = $conexao->prepare("SELECT id_loja_compra AS id_loja, nome_loja, id_pessoa, id_itens FROM Loja_compra WHERE id_loja_compra = ?");
    } else if ($tipo === 'venda') {
        $stmt = $conexao->prepare("SELECT id_loja_venda AS id_loja, nome_loja, id_pessoa, id_itens FROM Loja_vendas WHERE id_loja_venda = ?");
    } else {
        $retorno = [
            'status' => 'nok',
            'mensagem' => 'Tipo inválido',
            'data' => []
        ];
        header('Content-type:application/json;charset:utf-8');
        echo json_encode($retorno);
        exit;
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $tabela = [];
    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            $tabela[] = $linha;
        }
        $retorno = [
            'status' => 'ok',
            'mensagem' => 'Registro encontrado.',
            'data' => $tabela
        ];
    } else {
        $retorno = [
            'status' => 'nok',
            'mensagem' => 'Não há registros',
            'data' => []
        ];
    }

    $stmt->close();
    $conexao->close();
    header('Content-type:application/json;charset:utf-8');
    echo json_encode($retorno);
    exit;
}

// Sem id: retorna todas as lojas (mesma ideia do lojas_listar.php)
$sql = "(
    SELECT id_loja_compra as id_loja, nome_loja, id_pessoa, id_itens, 'Compra' as tipo 
    FROM Loja_compra
) UNION ALL (
    SELECT id_loja_venda as id_loja, nome_loja, id_pessoa, id_itens, 'Venda' as tipo 
    FROM Loja_vendas
)";

$stmt = $conexao->prepare($sql);
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
