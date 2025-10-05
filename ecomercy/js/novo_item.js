document.getElementById("enviar").addEventListener("click", function(){
    armazenar();
    window.location.href = "gerenciarItens.html";
});

function armazenar(){
    var listaItens = JSON.parse(localStorage.getItem("listaItens"));
    var obj = {nome: "", id:"", valor: ""};
    obj.nome = document.getElementById("nome").value;
    obj.id = document.getElementById("id").value;
    obj.valor = document.getElementById("valor").value;
    listaItens.push(obj);
    localStorage.setItem("listaItens",JSON.stringify(listaItens));    
}