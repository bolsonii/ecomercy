document.addEventListener('DOMContentLoaded', () => {
    carregarMateriaisDoBanco();
});

document.getElementById('criarMaterial').addEventListener('click', () => {
    window.location.href = 'criarMaterial.php';
});

async function carregarMateriaisDoBanco() {
    const retorno = await fetch("../../php/materiais/material_get.php");
    const resposta = await retorno.json();

    if (resposta.status == "nok") {
        document.getElementById('retorno').innerHTML = '<br><br><p class="paragrafo-top">Nenhum material cadastrado ainda.</p>';
        return;
    }

    var lista = resposta.data;
    var html = '<div class="row p-3 text-center">';

    for (let i = 0; i < lista.length; i++) {
        let precoFormatado = parseFloat(lista[i].preco).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

        html += `
        <div class="col-12 col-sm-6 col-lg-3 mb-3">
            <div class="card h-100">
            <button type="button" class="btn btn-outline-danger" aria-label="Close" onclick="excluir(${lista[i].id_materiais})"><i class="bi bi-x-lg"></i></button>
                <div class="card-body">
                    <h4 class="card-title">${lista[i].nome}</h4>
                    <p class="card-text"><strong>Preço:</strong> ${precoFormatado}</p>
                    <p class="card-text"><strong>Categoria:</strong> ${lista[i].categoria_produtos}</p>
                    <a href="../../pages/materiais/editarMaterial.php?id=${lista[i].id_materiais}" class="btn btn-primary">Editar</a>
                </div>
            </div>
        </div>`;
    }

    html += '</div>';
    document.getElementById('retorno').innerHTML = html;
}


async function excluir(id) {
    if (!confirm("Tem certeza que deseja excluir este material?")) {
        return;
    }

    const retorno = await fetch(`../../php/materiais/material_excluir.php?id=${id}`);
    const resposta = await retorno.json();

    if (resposta.status == "ok") {
        alert(resposta.mensagem);
        window.location.reload();
    } else {
        alert("ERRO: " + resposta.mensagem);
    }
}
