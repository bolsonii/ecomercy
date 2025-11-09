document.getElementById("criar_loja").addEventListener("click", function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    // Pega os valores do formulário (adaptado para o novo schema)
    const nome = document.getElementById("nome_loja").value;
    const id_itens = document.getElementById("id_itens").value; // Assumindo que você tem esse campo no HTML
    const tipoSwitch = document.getElementById("storeTypeSwitch");
    
    // 'compra' se o switch estiver marcado (true), 'venda' se não (false)
    const tipo = tipoSwitch.checked ? "compra" : "venda";

    // Validação
    if (!validarCamposLoja(nome, id_itens)) {
        return; // A função validarCamposLoja já deve ter mostrado um alerta
    }

    // Chama a função assíncrona para salvar
    salvarDadosLoja(nome, id_itens, tipo);
});

/**
 * Valida os campos.
 * (Note que removi email/cep e adicionei id_itens)
 */
function validarCamposLoja(nome, id_itens) {
    if (!nome.trim() || !id_itens.trim()) {
        alert("Preencha o nome da loja e selecione um item!");
        return false;
    }
    
    // Você pode adicionar mais validações aqui (ex: se id_itens é um número)
    if (isNaN(parseInt(id_itens))) {
        alert("O ID do item deve ser um número válido.");
        return false;
    }

    return true;
}

/**
 * Função assíncrona para salvar os dados via API
 */
async function salvarDadosLoja(nome, id_itens, tipo) {
    
    const fd = new FormData();
    fd.append("nome_loja", nome);
    fd.append("id_itens", id_itens);
    fd.append("tipo", tipo); // 'compra' ou 'venda'

    try {
        const retorno = await fetch("../php/loja/loja_set.php", {
            method: 'POST',
            body: fd
        });
        
        const resposta = await retorno.json();
        
        if (resposta.status == "ok") {
            alert("SUCESSO: A loja foi criada com sucesso!");
            // Redireciona para a página de lojas
            window.location.href = "../../pages/lojas/lojas.html";
        } else {
            // Mostra o erro vindo do PHP
            alert("ERRO: " + resposta.mensagem);
        }
    } catch (error) {
        console.error("Erro na requisição:", error);
        alert("Ocorreu um erro de comunicação. Tente novamente.");
    }
}