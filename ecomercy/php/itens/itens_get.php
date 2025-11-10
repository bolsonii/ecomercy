<?php
    include_once('conexao.php');
    //Configurando o padrão de retorno em todas as situações
    $retorno = [
        'status'   => '', //ok - nok
        'mensagem' => '', //mensagem que envia para o front
        'data'     => []
    ];

    if(isset($_GET['id'])){
        //Segunda situação - RECEBENDO O ID POR GET
        $stmt = $conexao->prepare("SELECT * FROM Itens WHERE id = ?");
        $stmt->bind_param("i",$_GET['id']);
    }else{
        //Primeira situação - SEM RECEBER O ID POR GET
        $stmt = $conexao->prepare("SELECT * FROM Itens");
    }
    
    //Recuperando informações do banco de dados
    //Vou executar a query
    $stmt->execute();
    $resultado = $stmt->get_result();

    //Criando um array vazio para receber o resultado do banco de dados
    $tabela = [];
    if($resultado->num_rows > 0){
        while($linha = $resultado->fetch_assoc()){
            $tabela[] = $linha;
        }
        $retorno = [
            'status'   => 'ok', //ok - nok
            'mensagem' => 'Sucesso, consulta efetuada.', //mensagem que envia para o front
            'data'     => $tabela
        ];

    }else{
        $retorno = [
            'status'   => 'nok', //ok - nok
            'mensagem' => 'Não há registros', //mensagem que envia para o front
            'data'     => []
        ];
    }

    //Fechamento do estado e conexão
    $stmt->close();
    $conexao->close();
    
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
?>