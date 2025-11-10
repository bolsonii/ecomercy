document.addEventListener("DOMContentLoaded", () => {
    valida_sessao(); // Ver se o usuário está logado
});

document.getElementById("enviar").addEventListener("click", () => {
    novo(); // Chama a função novo ao clicar no botão enviar    
});
async function novo(){ // Função assíncrona, ou seja, espera o retorno de uma promise;
    // Armazena os dados em variáveis;
    var titulo    = document.getElementById("titulo").value;
    var descricao = document.getElementById("descricao").value;
    const radioSelecionado = document.querySelector('input[name="categoria"]:checked');
    let valorEnviado = '';    
    if (radioSelecionado) {
        valorEnviado = radioSelecionado.value;
    } else {
        document.getElementById('resultado').innerText = 'Por favor, selecione uma categoria.';
        return; 
    }

    const fd = new FormData();
    fd.append("titulo", titulo);
    fd.append("descricao", descricao);
    fd.append("categoria", valorEnviado); 

    const retorno = await fetch("../../php/tutoriais/tutorial_novo.php", // Enviando o fd para o php
    // fetch realiza o envio dos dados e retorna uma promise; 
        {
          method: 'POST',
          body: fd  
        });

    try {
        const resposta = await retorno.json();
        if(resposta.status == "ok") {
            alert("SUCESSO: " + resposta.mensagem);
            window.location.href = "./tutoriais.html";
        } else {
            alert("ERRO: " + resposta.mensagem);
        }
    } catch(error) {
        console.error("Erro:", error);
        alert("ERRO ao processar resposta do servidor");
    }
}