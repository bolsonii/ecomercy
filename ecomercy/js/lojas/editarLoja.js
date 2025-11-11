let idLojaAtual = null;

document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  idLojaAtual = urlParams.get("id");

  if (!idLojaAtual) {
    mostrarAviso(true);
    return;
  }
  
  carregarDadosEdicao();

  document
    .getElementById("salvar_alteracoes")
    .addEventListener("click", salvarEdicao);
});

async function carregarItens(idItemSelecionado = null) {
  const selectItens = document.getElementById("id_itens");
  try {
    const response = await fetch("../../php/itens_listar.php");
    const resposta = await response.json();

    if (resposta.status === "ok" && resposta.data.length > 0) {
      selectItens.innerHTML = ''; 
      resposta.data.forEach((item) => {
        const option = document.createElement("option");
        option.value = item.id_itens;
        option.textContent = item.nome_item;
        selectItens.appendChild(option);
      });
      
      // Seleciona o item atual da loja
      if(idItemSelecionado) {
        selectItens.value = idItemSelecionado;
      }
    } else {
      selectItens.innerHTML = '<option value="" disabled>Nenhum item cadastrado</option>';
    }
  } catch (error) {
    console.error("Erro ao carregar itens:", error);
  }
}

// Padrão: editarItens.js (função buscar())
async function carregarDadosEdicao() {
  try {
    // Padrão: ..._get.php?id=...
    const retorno = await fetch(`../../php/loja/loja_get.php?id=${idLojaAtual}`);
    const resposta = await retorno.json();

    if (resposta.status !== 'ok' || !resposta.data || resposta.data.length === 0) {
      mostrarAviso(true);
      return;
    }

    const dadosLoja = resposta.data[0];
    mostrarAviso(false);
    
    document.getElementById('nome_loja').value = dadosLoja.nome_loja;

    // Carrega os itens e JÁ seleciona o item da loja
    await carregarItens(dadosLoja.id_itens); 

    const tipoSwitch = document.getElementById('storeTypeSwitch');
    // tipo_loja == 1 (Compra) -> checked = true
    tipoSwitch.checked = (dadosLoja.tipo_loja == 1); 
    tipoSwitch.disabled = true;

    // ... (lógica para desabilitar label) ...

  } catch (error) {
    console.error("Erro ao carregar dados da loja:", error);
    mostrarAviso(true);
  }
}

async function salvarEdicao() {
  const nome = document.getElementById("nome_loja").value.trim();
  const id_itens = document.getElementById("id_itens").value;

  if (!nome || !id_itens) {
    alert("Preencha todos os campos!");
    return;
  }

  const fd = new FormData();
  fd.append('nome_loja', nome);
  fd.append('id_itens', id_itens);
  // Não precisamos enviar o 'tipo', ele não pode ser alterado.

  try {
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