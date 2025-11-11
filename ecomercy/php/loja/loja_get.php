<?php
include_once('../conexao.php');
session_start();

$retorno = [
    'status' => 'nok',
    'mensagem' => 'Ocorreu um erro',
    'data' => []
];

// Buscar uma loja específica (para edição)
if (isset($_GET['id'])) {
    $id_loja = (int)$_GET['id'];
    
    $stmt = $conexao->prepare("SELECT * FROM Loja WHERE id_loja = ?");
    $stmt->bind_param('i', $id_loja);
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
} 
// Buscar todas as lojas de outros usuários (para listagem)
else {
    $id_pessoa_logada = $_SESSION['id_pessoa'] ?? 0;

    // Busca todas as lojas que NÃO são do usuário logado
    $stmt = $conexao->prepare("SELECT * FROM Loja WHERE id_pessoa != ?");
    $stmt->bind_param("i", $id_pessoa_logada);
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
}

$conexao->close();
header('Content-type:application/json;charset:utf-8');
echo json_encode($retorno);
