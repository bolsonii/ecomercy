<?php
include_once('../conexao.php');
session_start(); 

$retorno = [
    'status'   => 'nok',
    'mensagem' => 'Usuário ou senha inválidos.',
    'data'     => []
];

$usuario_form = $_POST['usuario'];
$senha_form = $_POST['senha'];

$stmt = $conexao->prepare("SELECT * FROM cliente WHERE usuario = ?");
$stmt->bind_param("s", $usuario_form);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
   $usuario_db = $resultado->fetch_assoc();

        if ($senha_form === $usuario_db['senha']) {
        
        $_SESSION['id_cliente'] = $usuario_db['id'];
        $_SESSION['usuario'] = $usuario_db['usuario'];

        $retorno = [
            'status'   => 'ok',
            'mensagem' => 'Login efetuado com sucesso.',
            'data'     => [
                'id' => $usuario_db['id'],
                'usuario' => $usuario_db['usuario']
            ]
        ];
    }
}

$stmt->close();
$conexao->close();

header("Content-type:application/json;charset:utf-8");
echo json_encode($retorno);
?>