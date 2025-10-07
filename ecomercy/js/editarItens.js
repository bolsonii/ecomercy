document.addEventListener("DOMContentLoaded", function() {
    // Recupera o índice do item a ser editado
    const index = localStorage.getItem("editItem");
    // Recupera a lista de itens do localStorage
    const lista = JSON.parse(localStorage.getItem("listaItens"));
    // Se existir o item, preenche os campos do formulário
    if (index !== null && lista && lista[index]) {
        document.getElementById("nome").value = lista[index].nome;
        document.getElementById("id").value = lista[index].id;
        document.getElementById("valor").value = lista[index].valor;
    }

    // Salva as alterações ao clicar no botão
    document.getElementById("enviar").addEventListener("click", function() {
        lista[index].nome = document.getElementById("nome").value;
        lista[index].id = document.getElementById("id").value;
        lista[index].valor = document.getElementById("valor").value;
        localStorage.setItem("listaItens", JSON.stringify(lista));
        localStorage.removeItem("editItem");
        window.location.href = "gerenciarItens.html";
    });
});