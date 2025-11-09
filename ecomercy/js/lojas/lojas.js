document.addEventListener('DOMContentLoaded', function() {
    carregarMinhasLojas();    
    carregarOutrasLojas();
});

/**
 * Função para criar o HTML de um card de loja.
 * Adaptada para os dados vindos da API (nome_loja, id_itens, tipo).
 */
function criarCardHTML(loja, isUsuario = false) {
    // 'loja' agora é um objeto como: 
    // { id_loja: 1, nome_loja: "Minha Loja", id_itens: 5, tipo: "Compra" }

    const imagemSrc = '../../assets/lojas/padrao.jpeg'; // Imagem padrão
    const classeCard = isUsuario ? 'user-loja-card' : '';
    const etiqueta = isUsuario ? '<span class="badge user-badge position-absolute top-0 start-0 m-3">Sua Loja</span>' : '';
    
    // O botão de editar agora passa o ID e o TIPO pela URL
    const editButtonHTML = isUsuario ? `
        <a href="editarLoja.html?id=${loja.id_loja}&tipo=${loja.tipo.toLowerCase()}" class="edit-store-btn" title="Editar Loja">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>`
        : '';
        
    return `
        <div class="${isUsuario ? 'col-12' : 'col-md-6 col-lg-4'}">
            <div class="card-loja ${classeCard} position-relative">
                ${editButtonHTML} 
                ${etiqueta}
                <img src="${imagemSrc}" class="card-img-top" alt="Capa da loja ${loja.nome_loja}">
                <div class="card-body">
                    <h5 class="card-titulo">${loja.nome_loja}</h5>
                    <h6 class="card-subtitulo mb-3">
                        <i class="fas fa-${loja.tipo === 'Venda' ? 'tags' : 'shopping-cart'}"></i>
                        Loja de ${loja.tipo}
                    </h6>
                    <div class="loja-info mt-4">
                        <p><i class="fas fa-box"></i> Item principal (ID): ${loja.id_itens}</p>
                        </div>
                </div>
            </div>
        </div>
    `;
}

/**
 * Busca e renderiza as lojas do usuário logado (Compra e Venda)
 */
async function carregarMinhasLojas() {
    const containerUsuario = document.getElementById('container-loja-usuario');
    containerUsuario.innerHTML = ""; // Limpa o container

    try {
        const retorno = await fetch('../php/loja/minha_loja.php');
        const resposta = await retorno.json();

        if (resposta.status !== 'ok') {
            throw new Error(resposta.mensagem);
        }

        let hasLoja = false;

        // Renderiza a loja de COMPRA (se existir)
        if (resposta.data.compra) {
            hasLoja = true;
            const lojaCompra = {
                id_loja: resposta.data.compra.id_loja_compra,
                nome_loja: resposta.data.compra.nome_loja,
                id_itens: resposta.data.compra.id_itens,
                tipo: 'Compra' // Define o tipo manualmente
            };
            containerUsuario.innerHTML += criarCardHTML(lojaCompra, true);
        }

        // Renderiza a loja de VENDA (se existir)
        if (resposta.data.venda) {
            hasLoja = true;
            const lojaVenda = {
                id_loja: resposta.data.venda.id_loja_venda,
                nome_loja: resposta.data.venda.nome_loja,
                id_itens: resposta.data.venda.id_itens,
                tipo: 'Venda' // Define o tipo manualmente
            };
            containerUsuario.innerHTML += criarCardHTML(lojaVenda, true);
        }

        // Se não tem nenhuma, mostra a mensagem para criar
        if (!hasLoja) {
            containerUsuario.innerHTML = `
                <div class="no-store-message">
                    <h4>Você ainda não criou nenhuma loja.</h4>
                    <p>É rápido e fácil. <a href="../../pages/lojas/criarLoja.html">Comece agora mesmo!</a></p> 
                </div>
            `;
        }

    } catch (error) {
        console.error("Erro ao carregar lojas do usuário:", error);
        containerUsuario.innerHTML = `<p class='text-danger'>Erro ao carregar sua(s) loja(s). Tente recarregar a página.</p>`;
    }
}

/**
 * Busca e renderiza as lojas de OUTROS usuários
 */
async function carregarOutrasLojas() {
    const containerOutras = document.getElementById('container-outras-lojas');
    containerOutras.innerHTML = ""; // Limpa

    try {
        const retorno = await fetch('../php/loja/lojas_listar.php');
        const resposta = await retorno.json();

        if (resposta.status !== 'ok') {
            throw new Error(resposta.mensagem);
        }

        let outrasLojasHTML = '';
        if (resposta.data.length > 0) {
            // O PHP já manda a lista unificada com o campo 'tipo'
            resposta.data.forEach(loja => {
                outrasLojasHTML += criarCardHTML(loja, false);
            });
        } else {
            outrasLojasHTML = "<p>Nenhuma outra loja encontrada no momento.</p>";
        }
        containerOutras.innerHTML = outrasLojasHTML;
        
    } catch (error) {
        console.error("Erro ao listar outras lojas:", error);
        containerOutras.innerHTML = "<p class='text-danger'>Erro ao carregar outras lojas. Tente recarregar a página.</p>";
    }
}