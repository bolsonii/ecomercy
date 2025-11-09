<?php
    include_once('conexao.php');
    $retorno = [
        'status' => '', 
        'mensagem' => ''
    ];

    $endereco = $_POST['endereco'];
    $hora     = $_POST['hora'];
    $loja     = $_POST['loja'];

    $stmt = $conexao->prepare("INSERT INTO ponto_coleta (endereco, hora, loja) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $endereco, $hora, $loja);
    $stmt->execute();

    if($stmt->affected_rows > 0){
        $retorno = [
            'status' => 'ok', 
            'mensagem' => 'Ponto de coleta inserido com sucesso!'
        ];
    } else {
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'Falha ao inserir o ponto de coleta.'
        ];
    }
    $stmt->close();
    $conexao->close();

    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
?>