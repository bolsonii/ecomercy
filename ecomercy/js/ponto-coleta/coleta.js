document.addEventListener('DOMContentLoaded', () => {
    carregarPontos();
});

document.getElementById('criarColeta').addEventListener('click', () => {
    window.location.href = 'criarColeta.html';
});

function carregarPontos() {
    var lista = JSON.parse(localStorage.getItem('listaColeta')) || [];
        
    if (lista.length === 0) {
        document.getElementById('retorno').innerHTML = '<br><br><p class="paragrafo-top">Nenhum ponto de coleta cadastrado ainda.</p>';
        return;
    }

    var html = '<div class="row p-3 text-center">';

    for (let i = 0; i < lista.length; i++) {
    html += `
        <div class="col-12 col-sm-6 col-lg-3 mb-3">
            <div class="card h-100">
            <button type="button" class="btn btn-outline-danger" aria-label="Close" onclick="excluir(${i})"><i class="bi bi-x-lg"></i></button>
                <div class="card-body">
                    <h4 class="card-title">${lista[i].loja}</h4>
                    <p class="card-text"><strong>Endereço:</strong> ${lista[i].endereco}</p>
                    <p class="card-text"><strong>Horário:</strong> ${lista[i].hora}</p>
                    <a href="../../pages/ponto-coleta/editarColeta.html?id=${i}" class="btn btn-primary">Editar</a>
                </div>
            <img class="card-img-bottom" src="../../assets/coleta/praca.jpg" alt="Imagem do ponto de coleta">
            </div>
        </div>`;
    }
    
    html += '</div>';
    document.getElementById('retorno').innerHTML = html;
}

function excluir(id) {
    let lista = JSON.parse(localStorage.getItem('listaColeta'));
    lista.splice(id, 1);
    localStorage.setItem('listaColeta', JSON.stringify(lista));
    window.location.reload();
}