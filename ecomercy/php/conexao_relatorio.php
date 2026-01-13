<?php
$servidor = "localhost:3306";
$usuario  = "relatorio_user";
$senha    = "Senha123!";
$nome_banco = "Ecomercy";

$conexao = new mysqli($servidor, $usuario, $senha, $nome_banco);
if($conexao->connect_error){
    echo $conexao->connect_error;
}
