<?php
include_once('../conexao.php'); // Verifique se o 'conexao.php' está em ../
$retorno = ['status' => 'ok', 'data' => []];

$sql = "SELECT id AS id_itens, nome AS nome_item FROM Itens ORDER BY nome";
$resultado = $conexao->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $retorno['data'][] = $row;
    }
}

$conexao->close();
header("Content-type:application/json;charset:utf-8");
echo json_encode($retorno);
?>