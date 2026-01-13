<?php
    include_once('../conexao.php');
    $retorno = [
        'status' => '', 
        'mensagem' => ''
    ];

    if(isset($_GET['id'])){
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $categoria = $_POST['categoria'];
        $id = $_GET['id'];

        $stmt = $conexao->prepare("UPDATE tutorial SET titulo = ?, descricao = ?, categoria = ? WHERE id_tutorial = ?");
        $stmt->bind_param("sssi", $titulo, $descricao, $categoria, $id);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            $retorno = [
                'status' => 'ok', 
                'mensagem' => 'Tutorial alterado com sucesso.'
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
