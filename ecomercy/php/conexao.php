<?php
// Variáveis de conexão com o Banco de Dados
$servidor = "localhost:3306";
$usuario  = "root";
$senha    = "Hm10082007$";
$nome_banco = "Ecomercy";

$conexao = new mysqli($servidor, $usuario, $senha, $nome_banco);
if($conexao->connect_error){
    echo $conexao->connect_error;
}


// criarMateriais.js - editarMateriais.js - materiais.js - material_novo.php - material_alterar.php - material_excluir.php - criarMaterial.html - editarMaterial.html - materiais.html