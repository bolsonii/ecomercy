let idLojaAtual = null;
let tipoLojaAtual = null;

async function carregarItens() {
  const selectItens = document.getElementById("id_itens");

  try {
    const response = await fetch("../../php/itens_listar.php");
    const resposta = await response.json();

    if (resposta.status === "ok" && resposta.data.length > 0) {
      resposta.data.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id_itens;
        option.textContent = item.nome_item;
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

document.addEventListener("DOMContentLoaded", function () {
  // Pega os parâmetros da URL
  const urlParams = new URLSearchParams(window.location.search);
  idLojaAtual = urlParams.get("id");
  tipoLojaAtual = urlParams.get("tipo");

  if (!idLojaAtual || !tipoLojaAtual) {
    mostrarAviso(true);
    return;
  }
  carregarItens();
  carregarDadosEdicao();
  document
    .getElementById("salvar_alteracoes")
    .addEventListener("click", salvarEdicao);
  document
    .getElementById("excluir_loja")
    .addEventListener("click", excluirLoja);
});

async function carregarDadosEdicao() {
  try {
    // Buscar diretamente o registro específico seguindo o padrão de itens (loja_get.php?id=..&tipo=..)
    const retorno = await fetch(`../../php/loja/loja_get.php?id=${idLojaAtual}&tipo=${tipoLojaAtual}`);
    const resposta = await retorno.json();

    if (resposta.status !== 'ok' || !resposta.data || resposta.data.length === 0) {
      mostrarAviso(true);
      return;
    }

    const dadosLoja = resposta.data[0];
    mostrarAviso(false);
    document.getElementById('nome_loja').value = dadosLoja.nome_loja;
    document.getElementById('id_itens').value = dadosLoja.id_itens;

    const tipoSwitch = document.getElementById('storeTypeSwitch');
    tipoSwitch.checked = tipoLojaAtual === 'compra';
    tipoSwitch.disabled = true;

    const switchLabel = document.querySelector('label[for="storeTypeSwitch"]');
    if (switchLabel) {
      switchLabel.title = 'O tipo da loja (Compra/Venda) não pode ser alterado após a criação.';
      switchLabel.style.cursor = 'not-allowed';
    }
  } catch (error) {
    console.error("Erro ao carregar dados da loja:", error);
    mostrarAviso(true);
  }
}

async function salvarEdicao() {
  const nome = document.getElementById("nome_loja").value.trim();
  const id_itens = document.getElementById("id_itens").value.trim();

  if (!nome || !id_itens) {
    alert("Preencha todos os campos!");
    return;
  }

  const fd = new FormData();
  fd.append('nome_loja', nome);
  fd.append('id_itens', id_itens);
  // tipo necessário para escolher tabela no backend
  fd.append('tipo', tipoLojaAtual);

  try {
    // Seguir padrão dos itens: enviar dados via POST e passar id via GET
    const retorno = await fetch(`../../php/loja/loja_update.php?id=${idLojaAtual}`, {
      method: 'POST',
      body: fd
    });

    const resposta = await retorno.json();
    if (resposta.status === 'ok') {
      alert('SUCESSO: ' + resposta.mensagem);
      window.location.href = 'lojas.html';
    } else {
      alert('ERRO: ' + resposta.mensagem);
    }
  } catch (error) {
    console.error('Erro ao salvar:', error);
    alert('Ocorreu um erro de comunicação.');
  }
}

async function excluirLoja() {
  if (
    !confirm(
      "Tem certeza que deseja excluir esta loja? Esta ação não pode ser desfeita."
    )
  ) {
    return;
  }

  try {
    // Seguir padrão dos itens: exclusão por GET passando id (aqui também o tipo)
    const retorno = await fetch(`../../php/loja/loja_excluir.php?id=${idLojaAtual}&tipo=${tipoLojaAtual}`);
    const resposta = await retorno.json();
    if (resposta.status === 'ok') {
      alert('SUCESSO: ' + resposta.mensagem);
      window.location.href = 'lojas.html';
    } else {
      alert('ERRO: ' + resposta.mensagem);
    }
  } catch (error) {
    console.error('Erro ao excluir:', error);
    alert('Ocorreu um erro de comunicação.');
  }
}

function mostrarAviso(mostrar) {
  const formWrapper = document.getElementById("form-wrapper");
  const avisoSemLoja = document.getElementById("sem-loja-aviso");

  if (mostrar) {
    formWrapper.classList.add("d-none");
    avisoSemLoja.classList.remove("d-none");
  } else {
    avisoSemLoja.classList.add("d-none");
    formWrapper.classList.remove("d-none");
  }
}
