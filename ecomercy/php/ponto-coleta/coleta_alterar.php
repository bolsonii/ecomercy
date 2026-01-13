<?php
    include_once('../conexao.php');
    $retorno = [
        'status' => '', 
        'mensagem' => ''
    ];

    if(isset($_GET['id'])){
        $endereco = $_POST['endereco'];
        $hora     = $_POST['hora'];
        $loja     = $_POST['loja'];
        $id       = $_GET['id'];

        $stmt = $conexao->prepare("UPDATE ponto_coleta SET endereco = ?, hora = ?, loja = ? WHERE id = ?");
        $stmt->bind_param("sssi", $endereco, $hora, $loja, $id);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            $retorno = [
                'status' => 'ok', 
                'mensagem' => 'Ponto de coleta alterado com sucesso.'
            ];
        } else {
            $retorno = [
                'status' => 'nok', 
                'mensagem' => 'Falha ao alterar o registro (ou nada foi modificado).'
            ];
        }
        $stmt->close();
    } else {
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'Nenhum ID informado para alteração.'
        ];
    }
    
    $conexao->close();
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
?>
