//Adicionar a lista de materiais com os botões de Editar e Excluir.
const mapeamento_categorias = {
  eletrodomesticos: "Eletrodomésticos",
  eletronicos: "Eletrônicos",
};

function carregaMateriais() {
  if (localStorage.getItem("materiais")) {
    var lista = JSON.parse(localStorage.getItem("materiais"));
    var html = "";
    html += "<table>";
    html += "<tr>";
    html += "<td>#</td>";
    html += "<td>Nome</td>";
    html += "<td>Preço</td>";
    html += "<td>Categoria</td>";
    html += "<td>#</td>";
    html += "</tr>";

    for (var i = 0; i < lista.length; i++) {
      var chaveCategoria = lista[i].categoria;
      var nomeExibido = mapeamento_categorias[chaveCategoria] || chaveCategoria;

      html += "<tr>";
      html += "<td><a href='javascript:excluir(" + i + ")'>Excluir</a></td>";
      html += "<td>" + lista[i].nome + "</td>";
      html += "<td>" + lista[i].preco + "</td>";
      html += "<td>" + nomeExibido + "</td>";
      html += "<td><a href='javascript:editar(" + i + ")'>Editar</a></td>";
      html += "</tr>";
    }

    html += "</table>";
    document.getElementById("lista").innerHTML = html;
  } else {
    var obj = { nome: "teste", preco: "teste", categoria: "teste" };
    var lista = [];
    lista.push(obj);
    localStorage.setItem("materiais", JSON.stringify(lista));
    window.location.reload();
  }
}

carregaMateriais();

function excluir(id) {
  var materiais = JSON.parse(localStorage.getItem("materiais"));
  materiais.splice(id, 1);
  localStorage.setItem("materiais", JSON.stringify(materiais));
  window.location.reload();
}

function editar(id) {
  localStorage.setItem("editMateriais", id);
  window.location.href = "editarMaterial.html";
}
