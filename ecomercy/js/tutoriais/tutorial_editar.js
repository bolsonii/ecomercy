// Fase 1
// a) PEGA o ID da URL 
// b) Requisita o BACKEND por GET
// c) Preenche o formulário com os dados do BACKEND
// ----------------------------------------------
document.addEventListener("DOMContentLoaded", () => {
    // pega a URL e armazena em um const
    // busca nessa URL a variável id e armazana no const id.
    valida_sessao();
    const url = new URLSearchParams(window.location.search); // search pega especificamente a partre da URL que vem após a ? 
    const id = url.get("id"); // .get() - função que recebe o parãmetro e ele o encontra na URL; (guardei o id em uma const)
    buscar(id); // Chama a função buscar com o parâmetro id (que veio da URL e foi armazenado na const);
});

async function buscar(id){
    const retorno = await fetch("../php/tutorial_get.php?id="+id);
    const resposta = await retorno.json();
    if(resposta.status == "ok"){
        alert("SUCESSO:" + resposta.mensagem);
        var registro = resposta.data[0];
        document.getElementById("titulo").value = registro.titulo; 
        document.getElementById("descricao").value = registro.descricao; 
        const categoriaDoBanco = registro.categoria;
    // Procura um input radio com o name="categorias" E o value="valor_do_banco"
        const radioParaMarcar = document.querySelector(`input[name="categoria"][value="${categoriaDoBanco}"]`);

        if (radioParaMarcar) {
        radioParaMarcar.checked = true; // Marca ele como selecionado
        }else{
        alert("ERRO:" + resposta.mensagem);
        window.location.href = "../home/";
        }  
    }
};
// ----------------------------------------------
// Fase 2
// Caso ele faça alguma alteração, quando ele clicar em enviar você pega novamente os dados e envia para o backend;
document.getElementById("salvarTutorial").addEventListener("click", () => {
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
    const radioSelecionado = document.querySelector('input[name="categoria"]:checked');
    let valorEnviado = '';
    if (radioSelecionado) {
        valorEnviado = radioSelecionado.value;
    } else {
        document.getElementById('resultado').innerText = 'ERRO: Por favor, selecione uma categoria.';
        return; 
    } 
    
    const fd = new FormData();
    fd.append("titulo", titulo);
    fd.append("descricao", descricao);
    fd.append("categoria",valorEnviado);

    const retorno = await fetch("../php/tutorial_alterar.php?id="+id,  // O ID vem pela URL (get) 
        {
          method: 'POST',  // Os dados confidencias dos usuários vão "lacrados"
          body: fd  
        });
    const resposta = await retorno.json();
    if(resposta.status == "ok"){
        alert("SUCESSO: " + resposta.mensagem);
        window.location.href = '../home/'
    }else{
        alert("ERRO: " + resposta.mensagem);
    }
}