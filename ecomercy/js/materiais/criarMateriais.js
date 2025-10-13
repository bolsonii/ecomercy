function validarCamposMateriais() {
  const nomeInput = document.getElementById("nome_material");
  const precoInput = document.getElementById("preco_material");
  if (!nomeInput.value.trim() || !precoInput.value.trim()) {
    alert("Preencha todos os campos!");
    return false;
  }
  return true;
}
document
  .getElementById("formMateriais")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    if (!validarCamposMateriais) {
      return;
    }

    salvarDadosMateriais();
    window.location.href = "../../pages/materiais/material.html";
  });

function salvarDadosMateriais() {
  const nomeInput = document.getElementById("nome_material");
  const precoInput = document.getElementById("preco_material");

  const todosMateriais = JSON.parse(localStorage.getItem("Materiais")) || [];

  const novoMaterial = {
    nome: nomeInput.value,
    preco: precoInput.value,
    // Falta adicionar a categoria aqui
  };

  todosMateriais.push(novoMaterial);
  localStorage.setItem("materiais", JSON.stringify(todosMateriais));
  console.log("Salvo.");
}
