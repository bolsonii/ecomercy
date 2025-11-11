document.addEventListener("DOMContentLoaded", function () {
  carregarItens();
});

document
  .getElementById("criar_loja")
  .addEventListener("click", function (event) {
    event.preventDefault();

    const nome = document.getElementById("nome_loja").value;
    const id_itens = document.getElementById("id_itens").value;
    const tipoSwitch = document.getElementById("storeTypeSwitch");

    const tipo = tipoSwitch.checked ? 1 : 2;

    if (!nome.trim() || !id_itens) {
      alert("Preencha o nome da loja e selecione um item!");
      return;
    }
    salvarDadosLoja(nome, id_itens, tipo);
  });

async function carregarItens() {
  const selectItens = document.getElementById("id_itens");
  selectItens.innerHTML = '<option value="">Carregando...</option>';
  try {
    const response = await fetch("../../php/itens_listar.php"); 
    const resposta = await response.json();

    if (resposta.status === "ok" && resposta.data.length > 0) {
      selectItens.innerHTML = '<option value="" disabled selected>Selecione um item</option>';
      resposta.data.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id_itens; 
        option.textContent = item.nome_item; 
        selectItens.appendChild(option);
      });
    } else {
      selectItens.innerHTML = '<option value="" disabled>Nenhum item cadastrado</option>';
    }
  } catch (error) {
    console.error("Erro ao carregar itens:", error);
    selectItens.innerHTML = '<option value="" disabled>Erro ao carregar itens</option>';
  }
}

// Padrão: criarItens.js (função novo())
async function salvarDadosLoja(nome, id_itens, tipo_loja) {
  const fd = new FormData();
  fd.append("nome_loja", nome);
  fd.append("id_itens", id_itens);
  fd.append("tipo_loja", tipo_loja);

  try {
    const retorno = await fetch("../../php/loja/loja_set.php", {
      method: "POST",
      body: fd,
    });

    const resposta = await retorno.json();

    if (resposta.status === "ok") {
      alert("SUCESSO: A loja foi criada com sucesso!");
      window.location.href = "lojas.html";
    } else {
      alert("ERRO: " + resposta.mensagem);
    }
  } catch (error) {
    console.error("Erro na requisição:", error);
    alert("Ocorreu um erro de comunicação.");
  }
}