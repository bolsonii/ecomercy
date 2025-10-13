document.getElementById('salvarColeta').addEventListener('click', () => {
    armazenar();
    window.location.href = 'coleta.html'
})

function armazenar() {
    var lista = JSON.parse(localStorage.getItem('listaColeta')) || [];

    var obj = {endereco: "", hora: "", loja: ""};
    obj.endereco = document.getElementById('endereco').value;
    obj.hora = document.getElementById('hora').value;
    obj.loja = document.getElementById('loja').value;

    lista.push(obj);

    localStorage.setItem('listaColeta', JSON.stringify(lista));
}