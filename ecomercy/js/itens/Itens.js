document.addEventListener("DOMContentLoaded", () => {
    buscar();
});

document.getElementById("novo").addEventListener("click", () => {
    window.location.href = 'novoItem.html';
});

async function buscar(){
    const retorno = await fetch("../../php/itens/itens_get.php");
    const resposta = await retorno.json();
    if(resposta.status == "ok"){
        preencherTabela(resposta.data);    
    }
}

async function excluir(id){
    const retorno = await fetch("../../php/itens/itens_excluir.php?id="+id);
    const resposta = await retorno.json();
    if(resposta.status == "ok"){
        alert(resposta.mensagem);
        window.location.reload();    
    }else{
        alert(resposta.mensagem);
    }
}

function preencherTabela(tabela){
    var html = `
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>`;

    for(var i=0; i < tabela.length; i++){
        const precoFormatado = parseFloat(tabela[i].preco).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

        html += `
            <tr>
                <td>${tabela[i].id}</td>
                <td>${tabela[i].nome}</td>
                <td>${precoFormatado}</td>
                <td class="text-end">
                    <a href='editarItem.html?id=${tabela[i].id}' class="btn btn-warning btn-sm me-2">
                        <i class="bi bi-pencil-square"></i> Alterar
                    </a>
                    <a href='#' onclick='excluir(${tabela[i].id})' class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i> Excluir
                    </a>
                </td>
            </tr>
        `;
    }

    html += `
            </tbody>
        </table>`;
        
    document.getElementById("lista").innerHTML = html;
}