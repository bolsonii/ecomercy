// Executa o script quando o conteúdo da página estiver totalmente carregado
document.addEventListener('DOMContentLoaded', function() {
    

    const dadosSalvosJSON = localStorage.getItem('dadosLoja');
    const dadosLojaUsuario = JSON.parse(dadosSalvosJSON);

    // Dados de exemplo para "Outras Lojas" 
    const outrasLojas = [
        {
            nome: "Tech Components",
            email: "contato@techcomp.com",
            cep: "80000-001",
            tipo: "Venda",
            fotoCapa: "../../assets/lojas/componentes.jpeg"
        },
        {
            nome: "Trade Stacks",
            email: "vendas@tradestacks.com",
            cep: "81000-002",
            tipo: "Venda",
            fotoCapa: "../../assets/lojas/pilhas.jpeg"
        },
        {
            nome: "Compro Celulares",
            email: "ofertas@cellcompro.com",
            cep: "82000-003",
            tipo: "Compra",
            fotoCapa: "../../assets/lojas/celulares.jpeg"
        },
            {
            nome: "NoteBuys",
            email: "contato@notebuys.com",
            cep: "83000-004",
            tipo: "Compra",
            fotoCapa: "../../assets/lojas/notebooks.jpeg"
        }
    ];

    const containerUsuario = document.getElementById('container-loja-usuario');
    const containerOutras = document.getElementById('container-outras-lojas');

    // Função para criar o HTML de um card de loja
    function criarCardHTML(loja, isUsuario = false) {
        // Se for a loja do usuário, sempre usa a imagem da loja dele
        //const imagemSrc = isUsuario ? loja.fotoCapa : (loja.fotoCapa || '../../assets/lojas/padrao.jpeg');
        const imagemSrc = isUsuario ? '../../assets/lojas/padrao.jpeg' : (loja.fotoCapa || '../../assets/lojas/padrao.jpeg');        

        const classeCard = isUsuario ? 'user-loja-card' : '';
        const etiqueta = isUsuario ? '<span class="badge user-badge position-absolute top-0 start-0 m-3">Sua Loja</span>' : '';
        const editButtonHTML = isUsuario ? `
            <a href="editarLoja.html" class="edit-store-btn" title="Editar Loja">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>`
            : '';
        return `
            <div class="${isUsuario ? 'col-12' : 'col-md-6 col-lg-4'}">
                <div class="card-loja ${classeCard} position-relative">
                    ${editButtonHTML} 
                    ${etiqueta}
                    <img src="${imagemSrc}" class="card-img-top" alt="Capa da loja ${loja.nome}">
                    <div class="card-body">
                        <h5 class="card-titulo">${loja.nome}</h5>
                        <h6 class="card-subtitulo mb-3">
                            <i class="fas fa-${loja.tipo === 'Venda' ? 'tags' : 'shopping-cart'}"></i>
                            Loja de ${loja.tipo}
                        </h6>
                        <div class="loja-info mt-4">
                            <p><i class="fas fa-envelope"></i> ${loja.email}</p>
                            <p><i class="fas fa-map-marker-alt"></i> CEP: ${loja.cep}</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Renderiza a loja do usuário
    if (dadosLojaUsuario) {
        // Se encontrou dados, cria o card
        containerUsuario.innerHTML = criarCardHTML(dadosLojaUsuario, true);
    } else {
        // Se não, mostra uma mensagem para criar a loja
        containerUsuario.innerHTML = `
            <div class="no-store-message">
                <h4>Você ainda não criou sua loja.</h4>
                <p>É rápido e fácil. <a href="../../pages/lojas/criarLoja.html">Comece agora mesmo!</a></p> 
            </div>
        `;
    }

    // Renderiza as outras lojas
    let outrasLojasHTML = '';
    outrasLojas.forEach(loja => {
        outrasLojasHTML += criarCardHTML(loja, false);
    });
    containerOutras.innerHTML = outrasLojasHTML;

});