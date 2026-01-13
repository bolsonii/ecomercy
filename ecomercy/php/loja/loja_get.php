<?php
    include_once('../conexao.php');
    session_start();

    $retorno = [
        'status' => '', 
        'mensagem' => '', 
        'data' => []
    ];

    if(isset($_GET['id'])){
        $id_loja = (int)$_GET['id'];
        
        $stmt = $conexao->prepare("SELECT * FROM Loja WHERE id_loja = ?");
        $stmt->bind_param('i', $id_loja);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if($resultado->num_rows > 0){
            $retorno = [
                'status' => 'ok', 
                'mensagem' => 'Registro encontrado.', 
                'data' => $resultado->fetch_all(MYSQLI_ASSOC)
            ];
        } else {
            $retorno = [
                'status' => 'nok', 
                'mensagem' => 'Registro não encontrado.', 
                'data' => []
            ];
        }
        $stmt->close();
    } else {
        $id_pessoa_logada = $_SESSION['id_pessoa'] ?? 0;

        $stmt = $conexao->prepare("SELECT * FROM Loja WHERE id_pessoa != ?");
        $stmt->bind_param("i", $id_pessoa_logada);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $lojas = [];
        if($resultado->num_rows > 0){
            while($row = $resultado->fetch_assoc()){
                $lojas[] = $row;
            }
            $retorno = [
                'status' => 'ok', 
                'mensagem' => 'Lojas listadas.', 
                'data' => $lojas
            ];
        } else {
            $retorno = [
                'status' => 'nok', 
                'mensagem' => 'Não há registros.', 
                'data' => []
            ];
        }
        $stmt->close();
    }

    $conexao->close();
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
?>

