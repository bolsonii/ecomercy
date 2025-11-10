async function valida_sessao(){ // Verificação de login 
    const retorno = await fetch("../php/valida_sessao.php"); // Contém o status http - sucesso ou erro na entrega para o backennd processar;
    const resposta = await retorno.json(); // Resposta do backend processada para json; (aquele template ok/nok)
    if(resposta.status == "nok"){ // Se a resposta enviada pelo back for negativa, o usuário é levado para a tela de login; 
        window.location.href = '../login/';
    }
}

// STATUS HTTP: 200: sucesso, 404: não encontrado, 500: erro interno do servidor;