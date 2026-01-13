document.getElementById('salvarColeta').addEventListener('click', () => {
    salvarNoBanco();
});

async function salvarNoBanco() {
    var obj = { endereco: "", hora: "", loja: "" };
    obj.endereco = document.getElementById('endereco').value;
    obj.hora = document.getElementById('hora').value;
    obj.loja = document.getElementById('loja').value;

    const fd = new FormData();
    fd.append("endereco", obj.endereco);
    fd.append("hora", obj.hora);
    fd.append("loja", obj.loja);

    const retorno = await fetch("../../php/ponto-coleta/coleta_nova.php", {
        method: 'POST',
        body: fd
    });

    const resposta = await retorno.json();

    if (resposta.status == "ok") {
        alert(resposta.mensagem);
        window.location.href = 'coleta.php';
    } else {
        alert("ERRO: " + resposta.mensagem);
    }
}
