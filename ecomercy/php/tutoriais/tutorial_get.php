<?php // Vê se a inserção funcionou e passa os dados em array associativo para a variaável tabela, que será convertida em JSON e enviada ao frontend;
   // Busca dados no bamnco para o front exibi-los na tela; 
   include_once('conexao.php');
    // Configurando o padrão de retorno em todas
    // as situações
    $retorno = [
        'status'    => '', // ok - nok
        'mensagem'  => '', // mensagem que envio para o front
        'data'      => []
    ];

    if(isset($_GET['id'])){ //Isset verifica se uma variável foi definida e se seu valor é != de null;
        // RECEBENDO O ID por GET
        $stmt = $conexao->prepare("SELECT * FROM tutorial WHERE id = ?"); // Preparando a consulta; 
        $stmt->bind_param("i",$_GET['id']); // Associa o id = ? ao id recebido por get; 
    }else{
        // Primeira situação - SEM RECEBER O ID por GET
        $stmt = $conexao->prepare("SELECT * FROM tutorial");
    }
    
    // Recuperando informações do banco de dados
    // Vou executar a query
    $stmt->execute();
    $resultado = $stmt->get_result(); // Pega o que ele inseriu no BD e coloca na variável resultado
    // Criando um array vazio para receber o resultado do banco de Dados
    $tabela = []; // Criando tabela vazia para inserir clientes e seus dados -> vai mandar pro js que vai colocar no html para ser visto
    if($resultado->num_rows > 0){
        while($linha = $resultado->fetch_assoc()){ // Fetch_assoc - pega os dados e organiza-os em objetos (nome da coluna vira a chave do array)
            $tabela[] = $linha; // Apenas = atribui, ou seja "tabela recebe linha" até que não tenha mais linhas para receber;
        }
        $retorno = [
            'status'    => 'ok', // ok - nok
            'mensagem'  => 'Sucesso, consulta efetuada.', // mensagem que envio para o front
            'data'      => $tabela // PASSA A TABELA COMPLETA COM OS DADOS PARA O FRONTEND
        ];
    }else{
        $retorno = [
            'status'    => 'nok', // ok - nok
            'mensagem'  => 'Não há registros', // mensagem que envio para o front
            'data'      => []
        ];
    }
    // Fechamento do estado e conexão.
    $stmt->close();
    $conexao->close();

    // Estou enviando para o FRONT o array RETORNO
    // mas no formato JSON
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno); // Manda o retorno para o frontend