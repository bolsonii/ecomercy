// Variáveis globais para guardar os dados da loja que está sendo editada
let idLojaAtual = null;
let tipoLojaAtual = null;

document.addEventListener("DOMContentLoaded", function() {
    // Pega os parâmetros da URL (ex: editarLoja.html?id=5&tipo=compra)
    const urlParams = new URLSearchParams(window.location.search);
    idLojaAtual = urlParams.get('id');
    tipoLojaAtual = urlParams.get('tipo'); // 'compra' ou 'venda'

    if (!idLojaAtual || !tipoLojaAtual) {
        // Se não veio ID ou Tipo, esconde o formulário e mostra o aviso
        mostrarAviso(true);
        return;
    }

    // Busca os dados da loja no backend para preencher o formulário
    carregarDadosEdicao();

    // Adiciona listener ao botão de SALVAR
    document.getElementById("salvar_alteracoes").addEventListener("click", salvarEdicao);
    
    // Adiciona listener ao botão de EXCLUIR
    document.getElementById("excluir_loja").addEventListener("click", excluirLoja);
});

/**
 * Busca os dados da loja do usuário e preenche o formulário
 */
async function carregarDadosEdicao() {
    try {
        const retorno = await fetch("../php/loja/minha_loja.php");
        const resposta = await retorno.json();

        if (resposta.status !== 'ok') {
            throw new Error(resposta.mensagem);
        }

        let dadosLoja = null;
        
        // Verifica qual loja (compra ou venda) corresponde ao ID da URL
        if (tipoLojaAtual === 'compra' && resposta.data.compra && resposta.data.compra.id_loja_compra == idLojaAtual) {
            dadosLoja = resposta.data.compra;
        } else if (tipoLojaAtual === 'venda' && resposta.data.venda && resposta.data.venda.id_loja_venda == idLojaAtual) {
            dadosLoja = resposta.data.venda;
        }

        if (dadosLoja) {
            // Loja encontrada, preenche o formulário
            mostrarAviso(false);
            
            // Assumindo que seu HTML tem 'nome_loja' e 'id_itens'
            document.getElementById("nome_loja").value = dadosLoja.nome_loja;
            document.getElementById("id_itens").value = dadosLoja.id_itens;

            // Define o switch e desabilita (não se pode mudar o tipo de uma loja)
            const tipoSwitch = document.getElementById("storeTypeSwitch");
            tipoSwitch.checked = (tipoLojaAtual === "compra");
            tipoSwitch.disabled = true; // Impede a alteração do tipo
            
            // Informa ao usuário que o tipo não pode ser mudado
            const switchLabel = document.querySelector('label[for="storeTypeSwitch"]');
            if (switchLabel) {
                switchLabel.title = "O tipo da loja (Compra/Venda) não pode ser alterado após a criação.";
                switchLabel.style.cursor = "not-allowed";
            }

        } else {
            // Se não achou a loja (ex: ID errado na URL), mostra o aviso
            mostrarAviso(true);
        }

    } catch (error) {
        console.error("Erro ao carregar dados da loja:", error);
        mostrarAviso(true);
    }// Adicionar após a validação básica e antes do INSERT

}

/**
 * Envia as alterações para o backend (UPDATE)
 */
async function salvarEdicao() {
    const nome = document.getElementById("nome_loja").value;
    const id_itens = document.getElementById("id_itens").value;
    
    // Validação simples
    if (!nome.trim() || !id_itens.trim()) {
        alert("Preencha todos os campos!");
        return;
    }

    const fd = new FormData();
    fd.append("id_loja", idLojaAtual);
    fd.append("tipo", tipoLojaAtual);
    fd.append("nome_loja", nome);
    fd.append("id_itens", id_itens);

    try {
        const retorno = await fetch("../php/loja/loja_update.php", {
            method: 'POST',
            body: fd
        });

        const resposta = await retorno.json();
        
        if (resposta.status == "ok") {
            alert("SUCESSO: " + resposta.mensagem);
            window.location.href = "lojas.html"; // Volta para a lista
        } else {
            alert("ERRO: " + resposta.mensagem);
        }
    } catch (error) {
        console.error("Erro ao salvar:", error);
        alert("Ocorreu um erro de comunicação.");
    }
}

/**
 * Envia o comando de exclusão para o backend (DELETE)
 */
async function excluirLoja() {
    // Confirmação crucial
    if (!confirm("Tem certeza que deseja excluir esta loja? Esta ação não pode ser desfeita.")) {
        return;
    }

    const fd = new FormData();
    fd.append("id_loja", idLojaAtual);
    fd.append("tipo", tipoLojaAtual);

    try {
        const retorno = await fetch("../php/loja/loja_excluir.php", {
            method: 'POST',
            body: fd
        });

        const resposta = await retorno.json();
        
        if (resposta.status == "ok") {
            alert("SUCESSO: " + resposta.mensagem);
            window.location.href = "lojas.html"; // Volta para a lista
        } else {
            alert("ERRO: " + resposta.mensagem);
        }
    } catch (error) {
        console.error("Erro ao excluir:", error);
        alert("Ocorreu um erro de comunicação.");
    }
}

/**
 * Controla a exibição do formulário vs. mensagem de erro
 */
function mostrarAviso(mostrar) {
    const formWrapper = document.getElementById('form-wrapper');
    const avisoSemLoja = document.getElementById('sem-loja-aviso');

    if (mostrar) {
        // Esconde o formulário e mostra o aviso
        formWrapper.classList.add('d-none');
        avisoSemLoja.classList.remove('d-none');
    } else {
        // Mostra o formulário e esconde o aviso
        avisoSemLoja.classList.add('d-none');
        formWrapper.classList.remove('d-none');
    }
}