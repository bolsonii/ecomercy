document.addEventListener('DOMContentLoaded', () => {
    carregarPontos();
});

document.getElementById('criarColeta').addEventListener('click', () => {
    window.location.href = 'criarColeta.html';
});

function carregarPontos() {
    var lista = JSON.parse(localStorage.getItem('listaColeta')) || [];
        
    if (lista.length === 0) {
        document.getElementById('retorno').innerHTML = '<p>Nenhum ponto de coleta cadastrado ainda.</p>';
        return;
    }

    var html = '<div class="row p-3 text-center">';

    for (let i = 0; i < lista.length; i++) {
    html += `
        <div class="col-12 col-sm-6 col-lg-3 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title">${lista[i].loja}</h4>
                    <p class="card-text"><strong>Endereço:</strong> ${lista[i].endereco}</p>
                    <p class="card-text"><strong>Horário:</strong> ${lista[i].hora}</p>
                    <a href="#" class="btn btn-primary">Ver Detalhes</a>
                </div>
            <img class="card-img-bottom" src="../../assets/coleta/praca.jpg" alt="Imagem do ponto de coleta">
            </div>
        </div>`;
    }
    
    html += '</div>';
    document.getElementById('retorno').innerHTML = html;
}