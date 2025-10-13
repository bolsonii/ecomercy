document.addEventListener("DOMContentLoaded", function () {
  // Recupera o índice do item a ser editado
  const index = localStorage.getItem("editMateriais");
  // Recupera a lista de itens do localStorage
  const lista = JSON.parse(localStorage.getItem("materiais"));
  // Se existir o item, preenche os campos do formulário
  if (index !== null && lista && lista[index]) {
    document.getElementById("nome_material").value = lista[index].nome;
    document.getElementById("preco_material").value = lista[index].preco;
    document.getElementById("categoria_material").value =
      lista[index].categoria;
  }

  // Salva as alterações ao clicar no botão
  document
    .getElementById("salvar_Material")
    .addEventListener("click", function () {
      lista[index].nome = document.getElementById("nome_material").value;
      lista[index].id = document.getElementById("preco_material").value;
      lista[index].categoria =
        document.getElementById("categoria_material").value;
      localStorage.setItem("materiais", JSON.stringify(lista));
      localStorage.removeItem("editMateriais");
      window.location.href = "../../pages/materiais/material.html";
    });
});
