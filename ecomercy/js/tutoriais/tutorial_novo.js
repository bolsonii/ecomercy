document.getElementById("enviar").addEventListener("click", () => {
    novo(); // Chama a função novo ao clicar no botão enviar    
});

async function novo(){
    var titulo    = document.getElementById("titulo").value;
    var descricao = document.getElementById("descricao").value;
    var categoria = document.getElementById("categoria").value;

    if(!categoria){
        document.getElementById('resultado').innerText = 'Por favor, selecione uma categoria.';
        return;
    }

    const fd = new FormData();
    fd.append("titulo", titulo);
    fd.append("descricao", descricao);
    fd.append("categoria", categoria);

    const retorno = await fetch("../../php/tutoriais/tutorial_novo.php",
        {
          method: 'POST',
          body: fd  
        });

    const resposta = await retorno.json();
    if(resposta.status == "ok"){
        alert("SUCESSO: " + resposta.mensagem);
        window.location.href = 'tutoriais.php';
    }else{
        alert("ERRO: " + resposta.mensagem);
    }
}
