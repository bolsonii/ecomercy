document.addEventListener('DOMContentLoaded', () => {

    const urlParams = new URLSearchParams(window.location.search);
    const idColeta = urlParams.get('id');

    document.getElementById('idColeta').value = idColeta;

    buscarDadosDaColeta(idColeta);
});

async function buscarDadosDaColeta(id) {
    const retorno = await fetch(`../../php/ponto-coleta/coleta_get.php?id=${id}`);
    const resposta = await retorno.json();

    if (resposta.status == "ok") {
        const coleta = resposta.data[0];

        document.getElementById('novoEndereco').value = coleta.endereco;
        document.getElementById('novoHora').value = coleta.hora;
        document.getElementById('novoLoja').value = coleta.loja;
    } else {
        alert("ERRO: " + resposta.mensagem);
        window.location.href = "../../pages/ponto-coleta/coleta.php";
    }
}

document.getElementById('editarColeta').addEventListener('click', () => {
    salvarAlteracao();
});

async function salvarAlteracao() {
    var id = document.getElementById('idColeta').value;
    var endereco = document.getElementById('novoEndereco').value;
    var hora = document.getElementById('novoHora').value;
    var loja = document.getElementById('novoLoja').value;

    const fd = new FormData();
    fd.append("endereco", endereco);
    fd.append("hora", hora);
    fd.append("loja", loja);

    const retorno = await fetch(`../../php/ponto-coleta/coleta_alterar.php?id=${id}`, {
        method: 'POST',
        body: fd
    });
    const resposta = await retorno.json();

    if (resposta.status == "ok") {
        alert(resposta.mensagem);
        window.location.href = "../../pages/ponto-coleta/coleta.php";
    } else {
        alert("ERRO: " + resposta.mensagem);
    }
}
