document.addEventListener("DOMContentLoaded", function () {
    // CORREÇÃO: A chave é "editTutorial" (singular)
    const indice = localStorage.getItem("editTutorial");
    const lista = JSON.parse(localStorage.getItem("listaTutoriais"));

    // Verifica se o índice e a lista são válidos
    if (indice !== null && lista && lista[indice]) {
        const tutorial = lista[indice];
        
        // Preenche os campos do formulário com os dados existentes
        // CORREÇÃO: IDs e propriedades ajustados para 'titulo' e 'descricao'
        document.getElementById("titulo").value = tutorial.titulo;
        document.getElementById("descricao").value = tutorial.descricao;

        // Marca o radio button da categoria salva
        const radios = document.querySelectorAll('input[name="categorias"]');
        radios.forEach(radio => {
            if (radio.value === tutorial.categoria) {
                radio.checked = true;
            }
        });

    } else {
        // Se não encontrar o tutorial, avisa o usuário e volta para a lista
        alert("Tutorial não encontrado para edição.");
        window.location.href = "../../pages/tutoriais/tutoriais.html";
        return;
    }

    // Adiciona o evento de clique para o botão salvar
    document.getElementById("salvarTutorial").addEventListener("click", function () {
        // CORREÇÃO: A variável com o índice é 'indice'.
        // CORREÇÃO: As propriedades são 'titulo' e 'descricao'.
        lista[indice].titulo = document.getElementById("titulo").value;
        lista[indice].descricao = document.getElementById("descricao").value;

        // Pega o novo valor da categoria selecionada
        const radioSelecionado = document.querySelector('input[name="categorias"]:checked');
        if (radioSelecionado) {
            lista[indice].categoria = radioSelecionado.value;
        }

        // CORREÇÃO: A variável da lista é 'lista', e não 'listaTutoriais' neste escopo.
        localStorage.setItem("listaTutoriais", JSON.stringify(lista));
        
        // Remove o item de edição para não interferir depois
        localStorage.removeItem("editTutorial");

        // CORREÇÃO: Redireciona de volta para a lista de tutoriais
        window.location.href = "../../pages/tutoriais/tutoriais.html";
    });
});