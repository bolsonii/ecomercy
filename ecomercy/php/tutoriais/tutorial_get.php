<?php
    include_once('../conexao.php');
    $retorno = [
        'status' => '', 
        'mensagem' => '', 
        'data' => []
    ];

    if(isset($_GET['id'])){
        $stmt = $conexao->prepare("SELECT id_tutorial AS id, titulo, descricao, categoria FROM tutorial WHERE id_tutorial = ?");
        $stmt->bind_param("i", $_GET['id']);
    } else {
        $stmt = $conexao->prepare("SELECT id_tutorial AS id, titulo, descricao, categoria FROM tutorial ORDER BY id");
    }
    
    $stmt->execute();
    $resultado = $stmt->get_result();

    if($resultado->num_rows > 0){
        $tabela = [];
        while($linha = $resultado->fetch_assoc()){
            $tabela[] = $linha;
        }
        $retorno = [
            'status' => 'ok', 
            'mensagem' => 'Consulta efetuada com sucesso.', 
            'data' => $tabela
        ];

    } else {
        $retorno = ['status' => 'nok', 
        'mensagem' => 'Não há registros.'
    ];
    }
    $stmt->close();
    $conexao->close();

    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
?>
