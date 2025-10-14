document.addEventListener('DOMContentLoaded', () => {
    var lista = JSON.parse(localStorage.getItem('listaColeta'));

    const urlParams = new URLSearchParams(window.location.search);
    const idColeta = urlParams.get('id');
    const coleta = lista[idColeta];

    document.getElementById('idColeta').value = idColeta;
    document.getElementById('novoEndereco').value = coleta.endereco;
    document.getElementById('novoHora').value = coleta.hora;
    document.getElementById('novoLoja').value = coleta.loja;
});

document.getElementById('editarColeta').addEventListener('click', () => {
    var lista = JSON.parse(localStorage.getItem('listaColeta'));

    var id = document.getElementById('idColeta').value;
    var endereco = document.getElementById('novoEndereco').value;
    var hora = document.getElementById('novoHora').value;
    var loja = document.getElementById('novoLoja').value;

    lista[id].endereco = endereco;
    lista[id].hora = hora;
    lista[id].loja = loja;

    localStorage.setItem('listaColeta', JSON.stringify(lista));
    window.location.href = "../../pages/ponto-coleta/coleta.html";
});