var idMaterial = null;

document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    idMaterial = urlParams.get('id');
    
    if (!idMaterial) {
        alert("ID do material não encontrado!");
        window.location.href = './material.html';
        return;
    }

    carregarDadosDoMaterial();

    document.getElementById('editarMaterial').addEventListener('click', () => {
        salvarAlteracoes();
    });
});

async function carregarDadosDoMaterial() {
    const retorno = await fetch(`../../php/materiais/material_get.php?id=${idMaterial}`);
    const resposta = await retorno.json();

    if (resposta.status == "ok" && resposta.data.length > 0) {
        const material = resposta.data[0];
        
        // 4. Popular o formulário
        document.getElementById('idMaterial').value = material.id_materiais;
        document.getElementById('novoNome').value = material.nome;
        document.getElementById('novoPreco').value = material.preco;
        document.getElementById('novoCategoria').value = material.categoria_produtos;
    } else {
        alert("Erro ao carregar os dados do material: " + resposta.mensagem);
        window.location.href = './material.html';
    }
}

async function salvarAlteracoes() {
    // 5. Coletar dados do formulário
    var obj = {
        nome: document.getElementById('novoNome').value,
        preco: document.getElementById('novoPreco').value,
        categoria_produtos: document.getElementById('novoCategoria').value
    };

    const fd = new FormData();
    fd.append("nome", obj.nome);
    fd.append("preco", obj.preco);
    fd.append("categoria_produtos", obj.categoria_produtos);

    const retorno = await fetch(`../../php/materiais/material_alterar.php?id=${idMaterial}`, {
        method: 'POST',
        body: fd
    });

    const resposta = await retorno.json();

    if (resposta.status == "ok") {
        alert(resposta.mensagem);
        window.location.href = './material.html';
    } else {
        alert("ERRO: " + resposta.mensagem);
    }
}