document.addEventListener("DOMContentLoaded", () => {
    buscar();
});

document.getElementById("novo").addEventListener("click", () => {
    window.location.href = 'tutorial_novo.html';
});

async function buscar(){
    const retorno = await fetch("../../php/tutoriais/tutorial_get.php");
    const resposta = await retorno.json();
    if(resposta.status == "ok"){
        preencherTabela(resposta.data);    
    }
}

async function excluir(id){
    const retorno = await fetch("../../php/tutoriais/tutorial_excluir.php?id="+id);
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
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>`;
    for(var i=0;i<tabela.length;i++){
        html += `
            <tr>
                <td>${tabela[i].id}</td>
                <td>${tabela[i].titulo}</td>
                <td>${tabela[i].descricao}</td>
                <td>${tabela[i].categoria_tutorial || tabela[i].categoria}</td>
                <td>
                    <div class="d-flex justify-content-end gap-2">
                        <a href='tutorial_editar.html?id=${tabela[i].id}' class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Alterar
                        </a>
                        <a href='#' onclick='excluir(${tabela[i].id})' class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Excluir
                        </a>
                    </div>
                </td>
            </tr>
        `;
    }
    html += `
            </tbody>
        </table>`;
    document.getElementById("lista").innerHTML = html;
}
