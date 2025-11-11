document.addEventListener("DOMContentLoaded", function () {
  carregarItens();
});

async function carregarItens() {
  const selectItens = document.getElementById("id_itens");

  try {
    const response = await fetch("../../php/itens_listar.php");
    const resposta = await response.json();

    if (resposta.status === "ok" && resposta.data.length > 0) {
      resposta.data.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id_itens;
        option.textContent = item.nome_item; // Ex: "Placa-mãe"
        selectItens.appendChild(option);
      });
    } else {
      selectItens.innerHTML =
        '<option value="" disabled>Nenhum item cadastrado</option>';
    }
  } catch (error) {
    console.error("Erro ao carregar itens:", error);
    selectItens.innerHTML =
      '<option value="" disabled>Erro ao carregar itens</option>';
  }
}

document
  .getElementById("criar_loja")
  .addEventListener("click", function (event) {
    event.preventDefault();

    const nome = document.getElementById("nome_loja").value;
    const id_itens = document.getElementById("id_itens").value;
    const tipoSwitch = document.getElementById("storeTypeSwitch");

    // 'compra' se o switch estiver marcado (true), 'venda' se não (false)
    const tipo = tipoSwitch.checked ? "compra" : "venda";

    if (!validarCamposLoja(nome, id_itens)) {
      return;
    }

    salvarDadosLoja(nome, id_itens, tipo);
  });

function validarCamposLoja(nome, id_itens) {
  if (!nome.trim() || !id_itens.trim()) {
    alert("Preencha o nome da loja e selecione um item!");
    return false;
  }

  if (isNaN(parseInt(id_itens))) {
    alert("O ID do item deve ser um número válido.");
    return false;
  }

  return true;
}

async function salvarDadosLoja(nome, id_itens, tipo) {
  const fd = new FormData();
  fd.append("nome_loja", nome);
  fd.append("id_itens", id_itens);
  fd.append("tipo", tipo);

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
    alert("Ocorreu um erro de comunicação. Tente novamente.");
  }
}
