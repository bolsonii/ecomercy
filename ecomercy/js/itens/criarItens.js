document.getElementById("enviar").addEventListener("click", () => {
    novo();
});

async function novo(){
    var nome    = document.getElementById("nome").value;
    var preco   = document.getElementById("preco").value;

    const fd = new FormData();
    fd.append("nome", nome);
    fd.append("preco", preco);

    const retorno = await fetch("../../php/itens/itens_novo.php",
    {
      method: 'POST',
      body: fd  
    });
    const resposta = await retorno.json();
    if(resposta.status == "ok"){
        alert("SUCESSO: " + resposta.mensagem);
        window.location.href = 'gerenciarItens.html'
    }else{
        alert("ERRO: " + resposta.mensagem);
    }
}