document.addEventListener("DOMContentLoaded", () => {
    if(!validaSessao()){
        window.location.href = '../login.html';
    }else{
        carregaItens();
    }    
});

document.getElementById("novo").addEventListener("click", function(){
    window.location.href = "novo_item.html";
});

function validaSessao(){
    if(localStorage.getItem("sessao")){
        return true;
    }else{
        return false;
    }
}

function carregaItens(){
    if(localStorage.getItem("listaItens")){
        var lista = JSON.parse(localStorage.getItem("listaItens"));
        var html = "";
        html += "<table>";
        html += "<tr>";
        html += "<td>#</td>";
        html += "<td>Nome</td>";
        html += "<td>Id</td>";
        html += "<td>Valor</td>";
        html += "</tr>";

        for(var i=0;i<lista.length;i++){
            html += "<tr>";
            html += "<td><a href='javascript:excluir("+i+")'>Excluir</a></td>";
            html += "<td>"+lista[i].nome+"</td>";
            html += "<td>"+lista[i].id+"</td>";
            html += "<td>"+lista[i].valor+"</td>";
            html += "</tr>";
        }

        html += "</table>";
        document.getElementById("lista").innerHTML = html;
    }else{
        var obj = {nome: "teste", id: "teste", valor: "teste"};
        var lista = [];
        lista.push(obj);
        localStorage.setItem("listaItens",JSON.stringify(lista));
        window.location.reload();
    }
}

function excluir(id){
    var listaItens = JSON.parse(localStorage.getItem("listaItens"));
    listaItens.splice(id,1);
    localStorage.setItem("listaItens",JSON.stringify(listaItens));
    window.location.reload();
}