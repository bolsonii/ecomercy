document.addEventListener("DOMContentLoaded", () => {
    const url = new URLSearchParams(window.location.search);
    const id = url.get("id");
    buscar(id);
});

async function buscar(id){
    const retorno = await fetch("../../php/tutoriais/tutorial_get.php?id="+id);
    const resposta = await retorno.json();
    if(resposta.status == "ok"){
        alert("SUCESSO:" + resposta.mensagem);
        var registro = resposta.data[0];
        document.getElementById("titulo").value = registro.titulo; 
        document.getElementById("descricao").value = registro.descricao;
        document.getElementById("id").value = id;
        const categoriaDoBanco = registro.categoria_tutorial || registro.categoria;
        const selectCategoria = document.getElementById('categoria');
        if(selectCategoria){
            selectCategoria.value = categoriaDoBanco || '';
        }
    }else{
        alert("ERRO:" + resposta.mensagem);
        window.location.href = "tutoriais.php";
    }  
};

document.getElementById("enviar").addEventListener("click", () => {
    alterar();
});

async function alterar(){
    const url = new URLSearchParams(window.location.search);
    const id = url.get("id");
    
    if (!id) {
        alert("ERRO: ID não encontrado na URL.");
        return;
    } 
    var titulo    = document.getElementById("titulo").value;
    var descricao = document.getElementById("descricao").value;
    var categoria = document.getElementById("categoria").value;
    
    if(!categoria){
        document.getElementById('resultado').innerText = 'ERRO: Por favor, selecione uma categoria.';
        return; 
    }
    
    const fd = new FormData();
    fd.append("titulo", titulo);
    fd.append("descricao", descricao);
    fd.append("categoria", categoria);

    const retorno = await fetch("../../php/tutoriais/tutorial_alterar.php?id="+id,
        {
          method: 'POST',
          body: fd  
        });
    const resposta = await retorno.json();
    if(resposta.status == "ok"){
        alert("SUCESSO: " + resposta.mensagem);
        window.location.href = 'tutoriais.php'
    }else{
        alert("ERRO: " + resposta.mensagem);
    }
}
