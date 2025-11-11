document.getElementById('salvarMaterial').addEventListener('click', () => {
    salvarNoBanco();
});

async function salvarNoBanco() {
    var obj = { preco: "", categoria_produtos: "", nome: "" };
    obj.nome = document.getElementById('nome').value;
    obj.preco = document.getElementById('preco').value;
    obj.categoria_produtos = document.getElementById('categoria_produtos').value;

    const fd = new FormData();
    fd.append("nome", obj.nome);
    fd.append("preco", obj.preco);
    fd.append("categoria_produtos", obj.categoria_produtos);

    const retorno = await fetch("../../php/materiais/material_novo.php", {
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