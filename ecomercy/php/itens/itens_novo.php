<?php
    include_once('../conexao.php');
    $retorno = [
        'status' => '', 
        'mensagem' => ''
    ];

    $nome = $_POST['nome'];
    $preco = $_POST['preco'];

    $stmt = $conexao->prepare("INSERT INTO Itens (nome, preco) VALUES (?, ?)");
    $stmt->bind_param("sd", $nome, $preco);
    $stmt->execute();

    if($stmt->affected_rows > 0){
        $retorno = [
            'status' => 'ok', 
            'mensagem' => 'Item inserido com sucesso!'
        ];
    } else {
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'Falha ao inserir o item.'
        ];
    }
    $stmt->close();
    $conexao->close();

    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
?>
