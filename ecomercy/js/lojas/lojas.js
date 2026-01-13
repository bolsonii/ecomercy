document.addEventListener("DOMContentLoaded", function () {
  carregarMinhasLojas();
  carregarOutrasLojas();
});

function criarCardHTML(loja, isUsuario = false) {
  const imagemSrc = "../../assets/lojas/padrao.jpeg";
  
  const classeCard = isUsuario ? "user-loja-card" : "";
  const etiqueta = isUsuario
    ? '<span class="badge user-badge position-absolute top-0 start-0 m-3">Sua Loja</span>'
    : "";

  const tipoInfo = {
    texto: loja.tipo_loja == 1 ? "Compra" : "Venda",
    icone: loja.tipo_loja == 1 ? "shopping-cart" : "tags",
  };

  const botoesHTML = isUsuario
    ? `
        <a href="editarLoja.php?id=${loja.id_loja}" class="edit-store-btn" title="Editar Loja">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="#" onclick="excluirLoja(${loja.id_loja})" class="delete-store-btn" title="Excluir Loja">
            <i class="fa-solid fa-trash"></i>
        </a>
        `
    : "";

  const itemInfoHTML = (loja.id_itens && loja.id_itens > 0)
    ? `<p><i class="fas fa-box"></i> Item principal: ${loja.nome_item || "Sem nome"}</p>`
    : `<p><i class="fas fa-box"></i> Sem item principal definido</p>`;

  return `
        <div class="${isUsuario ? "col-12" : "col-md-6 col-lg-4"}">
            <div class="card-loja ${classeCard} position-relative">
                ${botoesHTML} 
                ${etiqueta}
                <img src="${imagemSrc}" class="card-img-top" alt="Capa da loja ${loja.nome_loja}">
                <div class="card-body">
                    <h5 class="card-titulo">${loja.nome_loja}</h5>
                    <h6 class="card-subtitulo mb-3">
                        <i class="fas fa-${tipoInfo.icone}"></i>
                        Loja de ${tipoInfo.texto}
                    </h6>
                    <div class="loja-info mt-4">
                        ${itemInfoHTML}
                    </div>
                </div>
            </div>
        </div>
    `;
}

async function excluirLoja(id) {
  if (!confirm("Tem certeza que deseja excluir esta loja? Esta ação não pode ser desfeita.")) {
    return;
  }

  try {
    const fd = new FormData();
    fd.append('id_loja', id);

    const retorno = await fetch("../../php/loja/loja_excluir.php", {
      method: "POST",
      body: fd
    });
    
    const resposta = await retorno.json();
    
    if (resposta.status === "ok") {
      alert("SUCESSO: " + resposta.mensagem);
      carregarMinhasLojas();
    } else {
      alert("ERRO: " + resposta.mensagem);
    }
  } catch (error) {
    console.error("Erro ao excluir:", error);
    alert("Ocorreu um erro de comunicação.");
  }
}

async function carregarMinhasLojas() {
  const containerUsuario = document.getElementById("container-loja-usuario");
  containerUsuario.innerHTML = "";

  try {
    const retorno = await fetch("../../php/loja/minha_loja.php");
    const resposta = await retorno.json();

    if (resposta.status !== "ok") {
      throw new Error(resposta.mensagem);
    }

    if (resposta.data.length > 0) {
      resposta.data.forEach((loja) => {
        containerUsuario.innerHTML += criarCardHTML(loja, true);
      });
    } else {
      containerUsuario.innerHTML = `
                <div class="no-store-message">
                    <h4>Você ainda não criou nenhuma loja.</h4>
                    <p>É rápido e fácil. <a href="criarLoja.php">Comece agora mesmo!</a></p> 
                </div>
            `;
    }
  } catch (error) {
    console.error("Erro ao carregar lojas do usuário:", error);
    containerUsuario.innerHTML = `<p class='text-danger'>Erro ao carregar sua(s) loja(s).</p>`;
  }
}

async function carregarOutrasLojas() {
  const containerOutras = document.getElementById("container-outras-lojas");
  containerOutras.innerHTML = "";

  try {
    const retorno = await fetch("../../php/loja/loja_get.php");
    const resposta = await retorno.json();

    if (resposta.status !== "ok") {
      throw new Error(resposta.mensagem);
    }

    if (resposta.data.length > 0) {
      let outrasLojasHTML = "";
      resposta.data.forEach((loja) => {
        outrasLojasHTML += criarCardHTML(loja, false);
      });
      containerOutras.innerHTML = outrasLojasHTML;
    } else {
      containerOutras.innerHTML = "<p>Nenhuma outra loja encontrada no momento.</p>";
    }
  } catch (error) {
    console.error("Erro ao listar outras lojas:", error);
    containerOutras.innerHTML = "<p class='text-danger'>Erro ao carregar outras lojas.</p>";
  }
}
