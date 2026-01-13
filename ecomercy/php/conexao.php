<?php
ob_start();

$servidor = "localhost:3306";
$usuario  = "root";
$senha    = "";
$nome_banco = "Ecomercy";

$conexao = new mysqli($servidor, $usuario, $senha, $nome_banco);
if($conexao->connect_error){
    header("Content-type:application/json;charset:utf-8");
    die(json_encode(['status' => 'erro', 'mensagem' => 'Erro de conexão: ' . $conexao->connect_error]));
}
