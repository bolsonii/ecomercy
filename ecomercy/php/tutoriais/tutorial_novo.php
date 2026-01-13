<?php
    include_once('../conexao.php');
    $retorno = [
        'status' => '', 
        'mensagem' => ''
    ];

    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];

    $stmt = $conexao->prepare("INSERT INTO tutorial (titulo, descricao, categoria) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $titulo, $descricao, $categoria);
    $stmt->execute();

    if($stmt->affected_rows > 0){
        $retorno = [
            'status' => 'ok', 
            'mensagem' => 'Tutorial inserido com sucesso!'
        ];
    } else {
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'Falha ao inserir o tutorial.'
        ];
    }
    $stmt->close();
    $conexao->close();

    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
?>
