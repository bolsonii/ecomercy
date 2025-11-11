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

  // Adicionando o tipo ao objeto para os botões
  const tipoLoja = loja.tipo.toLowerCase();

  const botoesHTML = isUsuario
    ? `
        <a href="editarLoja.html?id=${loja.id_loja}&tipo=${tipoLoja}" class="edit-store-btn" title="Editar Loja">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="#" onclick="excluirLoja(${loja.id_loja}, '${tipoLoja}')" class="delete-store-btn" title="Excluir Loja">
            <i class="fa-solid fa-trash"></i>
        </a>
        `
    : "";

  return `
        <div class="${isUsuario ? "col-12" : "col-md-6 col-lg-4"}">
            <div class="card-loja ${classeCard} position-relative">
                ${botoesHTML} 
                ${etiqueta}
                <img src="${imagemSrc}" class="card-img-top" alt="Capa da loja ${
    loja.nome_loja
  }">
                <div class="card-body">
                    <h5 class="card-titulo">${loja.nome_loja}</h5>
                    <h6 class="card-subtitulo mb-3">
                        <i class="fas fa-${
                          tipoLoja === "venda" ? "tags" : "shopping-cart"
                        }"></i>
                        Loja de ${loja.tipo}
                    </h6>
                    <div class="loja-info mt-4">
                        <p><i class="fas fa-box"></i> Item principal (ID): ${
                          loja.id_itens
                        }</p>
                    </div>
                </div>
            </div>
        </div>
    `;
}

async function excluirLoja(id, tipo) {
  if (
    !confirm(
      "Tem certeza que deseja excluir esta loja? Esta ação não pode ser desfeita."
    )
  ) {
    return;
  }

  try {
    const retorno = await fetch(
      `../../php/loja/loja_excluir.php?id=${id}&tipo=${tipo}`
    );
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

    let hasLoja = false;

    if (resposta.data.compra) {
      hasLoja = true;
      const lojaCompra = {
        id_loja: resposta.data.compra.id_loja_compra,
        nome_loja: resposta.data.compra.nome_loja,
        id_itens: resposta.data.compra.id_itens,
        tipo: "Compra",
      };
      containerUsuario.innerHTML += criarCardHTML(lojaCompra, true);
    }

    if (resposta.data.venda) {
      hasLoja = true;
      const lojaVenda = {
        id_loja: resposta.data.venda.id_loja_venda,
        nome_loja: resposta.data.venda.nome_loja,
        id_itens: resposta.data.venda.id_itens,
        tipo: "Venda",
      };
      containerUsuario.innerHTML += criarCardHTML(lojaVenda, true);
    }

    if (!hasLoja) {
      containerUsuario.innerHTML = `
                <div class="no-store-message">
                    <h4>Você ainda não criou nenhuma loja.</h4>
                    <p>É rápido e fácil. <a href="criarLoja.html">Comece agora mesmo!</a></p> 
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

    let outrasLojasHTML = "";
    if (resposta.data.length > 0) {
      resposta.data.forEach((loja) => {
        outrasLojasHTML += criarCardHTML(loja, false);
      });
    } else {
      outrasLojasHTML = "<p>Nenhuma outra loja encontrada no momento.</p>";
    }
    containerOutras.innerHTML = outrasLojasHTML;
  } catch (error) {
    console.error("Erro ao listar outras lojas:", error);
    containerOutras.innerHTML =
      "<p class='text-danger'>Erro ao carregar outras lojas.</p>";
  }
}