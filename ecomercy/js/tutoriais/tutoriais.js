document.addEventListener("DOMContentLoaded", () => {
    carregaTutoriais();
});

document.getElementById("novo").addEventListener("click", function () {
    window.location.href = "../../pages/tutoriais/novoTutorial.html";
});

function carregaTutoriais() {
    // Conferir se existem dados para mostrar
    if (localStorage.getItem("listaTutoriais")) {
        var lista = JSON.parse(localStorage.getItem("listaTutoriais"));
        
        // Se a lista estiver vazia, mostra uma mensagem em vez de uma tabela vazia
        if (lista.length === 0) {
            document.getElementById("listaTutoriais").innerHTML = "<p>Nenhum tutorial cadastrado ainda.</p>";
            return; // Encerra a função aqui
        }

        var html = "";
        html += "<table class='table table-striped'>"; // Adicionando classes do Bootstrap para estilização
        html += "<thead><tr>"; // Usando thead para o cabeçalho
        html += "<th>#</th>";
        html += "<th>Título</th>"; // Corrigido de Nome para Título
        html += "<th>Descrição</th>";
        html += "<th>Categoria</th>";
        html += "<th>#</th>";
        html += "</tr></thead>";
        html += "<tbody>"; // Usando tbody para o corpo da tabela

        for (var i = 0; i < lista.length; i++) {
            html += "<tr>";
            html += `<td><button class='btn btn-danger btn-sm' onclick='excluir(${i})'>Excluir</button></td>`;
            // CORREÇÃO: Usando a propriedade 'titulo' que definimos no novoTutorial.js
            html += "<td>" + lista[i].titulo + "</td>";
            html += "<td>" + lista[i].descricao + "</td>";
            html += "<td>" + lista[i].categoria + "</td>";
            html += `<td><button class='btn btn-primary btn-sm' onclick='editar(${i})'>Editar</button></td>`;
            html += "</tr>";
        }
        html += "</tbody></table>";

        document.getElementById("listaTutoriais").innerHTML = html;

    } else { //caso a lista não exista no Localstorage
        // CORREÇÃO DO LOOP INFINITO:
        // 1. Criar um array vazio.
        // 2. Salvar no localStorage com o nome correto "listaTutoriais".
        var lista = [];
        localStorage.setItem("listaTutoriais", JSON.stringify(lista));
        window.location.reload(); // Recarrega a página para que execute o if novamente
    }
}

function excluir(id) {
    var listaTutoriais = JSON.parse(localStorage.getItem("listaTutoriais"));
    
    // CORREÇÃO: A variável correta é 'listaTutoriais', não 'listaItens'.
    listaTutoriais.splice(id, 1);
    
    localStorage.setItem("listaTutoriais", JSON.stringify(listaTutoriais));
    window.location.reload();
}

function editar(id) {
    // CORREÇÃO: Salva o índice com a chave "editTutorial" (singular).
    localStorage.setItem("editTutorial", id);
    // CORREÇÃO: O caminho provavelmente é dentro de /pages/tutoriais/
    window.location.href = "../../pages/tutoriais/editarTutorial.html";
}