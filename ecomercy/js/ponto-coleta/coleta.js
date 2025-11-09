document.addEventListener('DOMContentLoaded', () => {
    carregarPontosDoBanco();
});

document.getElementById('criarColeta').addEventListener('click', () => {
    window.location.href = 'criarColeta.html';
});

async function carregarPontosDoBanco() {
    const retorno = await fetch("../../php/coleta_get.php");
    const resposta = await retorno.json();

    if (resposta.status == "nok") {
        document.getElementById('retorno').innerHTML = '<br><br><p class="paragrafo-top">Nenhum ponto de coleta cadastrado ainda.</p>';
        return;
    }

    var lista = resposta.data;
    var html = '<div class="row p-3 text-center">';

    for (let i = 0; i < lista.length; i++) {
        html += `
        <div class="col-12 col-sm-6 col-lg-3 mb-3">
            <div class="card h-100">
            <button type="button" class="btn btn-outline-danger" aria-label="Close" onclick="excluir(${lista[i].id})"><i class="bi bi-x-lg"></i></button>
                <div class="card-body">
                    <h4 class="card-title">${lista[i].loja}</h4>
                    <p class="card-text"><strong>Endereço:</strong> ${lista[i].endereco}</p>
                    <p class="card-text"><strong>Horário:</strong> ${lista[i].hora}</p>
                    <a href="../../pages/ponto-coleta/editarColeta.html?id=${lista[i].id}" class="btn btn-primary">Editar</a>
                </div>
            <img class="card-img-bottom" src="../../assets/coleta/praca.jpg" alt="Imagem do ponto de coleta">
            </div>
        </div>`;
    }

    html += '</div>';
    document.getElementById('retorno').innerHTML = html;
}

async function excluir(id) {
    if (!confirm("Tem certeza que deseja excluir este ponto?")) {
        return;
    }

    const retorno = await fetch(`../../php/coleta_excluir.php?id=${id}`);
    const resposta = await retorno.json();

    if (resposta.status == "ok") {
        alert(resposta.mensagem);
        window.location.reload();
    } else {
        alert("ERRO: " + resposta.mensagem);
    }
}