let idLojaAtual = null;

document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  idLojaAtual = urlParams.get("id");

  if (!idLojaAtual) {
    mostrarAviso(true);
    return;
  }
  
  carregarDadosEdicao();

  document.getElementById("salvar_alteracoes").addEventListener("click", salvarEdicao);
  document.getElementById("excluir_loja").addEventListener("click", excluirLoja);
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

async function carregarDadosEdicao() {
  try {
    const retorno = await fetch(`../../php/loja/loja_get.php?id=${idLojaAtual}`);
    const resposta = await retorno.json();

    if (resposta.status !== 'ok' || !resposta.data || resposta.data.length === 0) {
      mostrarAviso(true);
      return;
    }

    const dadosLoja = resposta.data[0];
    mostrarAviso(false);
    
    document.getElementById('nome_loja').value = dadosLoja.nome_loja;

    await carregarItens(dadosLoja.id_itens); 

    const tipoSwitch = document.getElementById('storeTypeSwitch');
    tipoSwitch.checked = (dadosLoja.tipo_loja == 1); 
    tipoSwitch.disabled = true;

  } catch (error) {
    console.error("Erro ao carregar dados da loja:", error);
    mostrarAviso(true);
  }
}

async function salvarEdicao() {
  const nome = document.getElementById("nome_loja").value.trim();
  const id_itens = document.getElementById("id_itens").value;

  if (!nome) {
    alert("O nome da loja é obrigatório!");
    return;
  }

  const fd = new FormData();
  fd.append('nome_loja', nome);
  fd.append('id_itens', id_itens); 

  try {
    const retorno = await fetch(
      `../../php/loja/loja_update.php?id=${idLojaAtual}`,
      {
        method: "POST",
        body: fd,
      }
    );

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
  if (!confirm("Tem certeza que deseja excluir esta loja? Esta ação não pode ser desfeita.")) {
    return;
  }

  try {
    const fd = new FormData();
    fd.append('id_loja', idLojaAtual);

    const retorno = await fetch("../../php/loja/loja_excluir.php", {
      method: "POST",
      body: fd
    });
    
    const resposta = await retorno.json();
    
    if (resposta.status === "ok") {
      alert("SUCESSO: " + resposta.mensagem);
      window.location.href = 'lojas.html';
    } else {
      alert("ERRO: " + resposta.mensagem);
    }
  } catch (error) {
    console.error("Erro ao excluir:", error);
    alert("Ocorreu um erro de comunicação.");
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